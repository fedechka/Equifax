<?php

ini_set ('memory_limit', '8M');

/* Подключение к базе данных MySQL с помощью вызова драйвера */
$dsn = 'mysql:dbname=testtask;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}

$query = "
    SELECT COUNT(id)
    FROM `payments`
";
$stmt = $dbh->prepare($query);
$stmt->execute();
$total_count = $stmt->fetchColumn();
$page = 0;
$per_page = 1000;




/* 1. Вытаскиваем все записи из таблицы payments, у которых нет соответствующей записи в таблице credits  */
while ($total_count > $page * $per_page) {
    $start = $per_page * $page;
    $query = "
        SELECT p.id, p.cred_id
        FROM
            (SELECT
                id, cred_id
                FROM `payments`
                LIMIT " . $per_page . " OFFSET " . $start . "
            ) AS p
        LEFT JOIN `credits` AS cr ON (p.cred_id = cr.id)
        WHERE cr.id IS NULL
    ";

    $invalid_payments = [];
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $invalid_payments = $stmt->fetchAll();
    if (!empty($invalid_payments)) {
        foreach ($invalid_payments as $row) {
            print $row['id'] . "\t" . $row['cred_id'] . "\n";
        }
    }
    $page++;
}






/* 2. Для записей с просрочкой, отличной от нуля, формируем xml-файл  */
$page = 0;
$overdue = [];
$xml_string = "";

while ($total_count > $page * $per_page) {
    $start = $per_page * $page;
    $query = "
        SELECT *
        FROM `payments`
        LIMIT " . $per_page . " OFFSET " . $start . "
    ";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $overdue_payments = $stmt->fetchAll();
    foreach ($overdue_payments as $row) {
        $data_set = unserialize($row['data_set']);
        if ($data_set['overdue'] > 0) {
            $overdue[] = [
                'payment_id' => $row['id'],
                'cred_id' => $row['cred_id'],
                'overdue' => $data_set['overdue']
            ];
        }
    }
    $page++;
}

if (!empty ($overdue)) {
    $xml_string .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<payments>
";
    $invalid_cred_ids = [];
    foreach ($overdue as $row)  {
        $xml_element = "    <payment id=\"" . $row['payment_id'] ."\">
        <cred_id>" . $row['cred_id'] ."</cred_id>
        <overdue>" . $row['overdue'] ."</overdue>
    </payment>
";
        $xml_string .= $xml_element;
        /* 3. Проверяем валидность сформированного XML-элемента. */
        libxml_use_internal_errors(true);
        $xml = new DOMDocument();
        $xml->loadXML($xml_element);
        if (!$xml->schemaValidate('overdue_payments.xsd')) {
            $invalid_cred_ids[(string)$row['cred_id']] = 1;
        }
        
    }
    $xml_string .= "</payments>";
}






if (!empty($xml_string)) {
    $fp = fopen('overdue_payments.xml', 'w');
    fwrite($fp, $xml_string);
    fclose($fp);

    /* Если есть невалидные платежи, записываем их cred_id в отдельный лог */
    if (!empty($invalid_cred_ids)) {
        $fp = fopen('overdue_invalid_cred_ids.log', 'w');
        fwrite($fp, implode("\n",array_keys($invalid_cred_ids)));
        fclose($fp);
    }
}

echo "<br /><br />Memory usage: " . memory_get_peak_usage(TRUE)." bytes\n\n";