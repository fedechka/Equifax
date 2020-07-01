<?php foreach ($authors as $author): ?>
    <div class="panel panel-primary">
    <div class="panel-heading"><b><?= $author->name ?></b></div>
    <div class="panel-body">
        <p><?= $author->biography ?></p>
    </div>
    <table class="table">
        <thead class="thead">
            <tr class="info">
                <th>Год выпуска</th>
                <th>Название</th>
            </tr>
        </thead>
        <?php 
            $books = $author->books;
            foreach ($books as $book) {
                echo '<tr>';
                    echo '<td class="success" width="120">' . $book->date_manuf . '</td>';
                    echo '<td>' . $book->name . '</td>';
                echo '</tr>';
            }
        ?>
    </table>
</div>
<?php endforeach; ?>