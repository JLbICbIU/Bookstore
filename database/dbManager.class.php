<?php
class dbManager {

  private $conn;

  public function __construct() {
    global $conn;
    require('connect_config.php');
    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } else {
      // echo "Success connection";
    }
  }

  public function __destruct() {
    global $conn;
    $conn->close();
  }

  public function getBookOfTheMonth() {
    global $conn;
    $query = "SELECT books.title as title, book_stock.price as sale_price, books.price as price, book_stock.number_available as amount
    FROM book_stock
    INNER JOIN books
    ON books.IDB = book_stock.IDB LIMIT 1";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo '<p class="display-4">Книга месяца</p>';
        echo '<h1 class="display-5">'.$row["title"]."</h1>";
        echo '<h2 class="display-5"></br>Только сегодня <strike>'.$row["price"]." руб.</strike>"." ".$row["sale_price"]." руб.</h2>";
        echo '<h5 class="display-5"></br><u>Количество ограниченно '.$row["amount"]."</u></h5>";
      }
    } else {
      echo "Error mysql query.";
    }
  }

  public function getThemes() {
    global $conn;
    $query = "SELECT theme FROM theme";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo '<a class="p-2 text-muted" href="http://localhost/bookstore/searchByTheme.php/?theme='.$row["theme"].'">'.$row["theme"].'</a>';
      }
    } else {
      echo "Error mysql query.";
    }
  }

  public function getBooksByTheme($theme) {
    global $conn;
    $query = "SELECT books.title, books.price, authors.name, theme.theme, books.pages, books.AgeLimit
    FROM books
    INNER JOIN book_author_id ON books.IDB = book_author_id.IDB
    INNER JOIN authors ON authors.IDA = book_author_id.IDA
    INNER JOIN book_theme ON book_theme.IDB = books.IDB
    INNER JOIN theme ON theme.IDT = book_theme.IDT
    WHERE theme.theme = '$theme'
    GROUP BY title, name";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()): ?>
      <div class="col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary"><?php echo $row["name"]?></strong>
            <h3 class="mb-0"><?php echo $row["title"]?></h3>
            <div class="mb-1 text-muted"><?php echo $row["price"]?> руб.</div>
            <p class="card-text mb-auto"><?php echo $row["pages"]?> стр.</p>
            <p class="card-text mb-auto"><?php echo $row["AgeLimit"]?></p>
            <a href="#" class="stretched-link">Продолжить чтение</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img class="mb-4 justify-content-center" width="200px" height="250px" src="http://localhost/bookstore/src/img/book404.jpg"></img>
          </div>
        </div>
      </div>
      <?php endwhile;
    } else {
      echo "Ошибка при загрузке данных.";
    }
  }

  public function getBookStock($i) {
    //From second book
    global $conn;
    $query = "SELECT books.title, book_stock.price as sale_price, books.price, book_stock.number_available as amount
    FROM book_stock
    INNER JOIN books ON books.IDB=book_stock.IDB
    LIMIT $i,1;";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<h5>Книга №".($i+1)."</h5>";
        echo "<h3>".$row["title"]."</h3>";
        echo "<h4>"."<strike>".$row["price"]."</strike> ".$row["sale_price"]." руб.</h4>";
        echo "<p><u> Осталось в продаже: ".$row["amount"]."</u></p>";
      }
    } else {
      echo "Error mysql query.";
    }
  }

  public function checkUser ($usermail, $password) {
    global $conn;
    $query = "SELECT login FROM users WHERE mail='$usermail' and password=md5('$password')";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      return $row["login"];
    } else {
      return "notfound";
    }
  }

  public function addUser ($useremail, $username, $password) {
    global $conn;

    $query = "SELECT max(IDU) as IDU FROM users";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $IDU = $row["IDU"];
    $IDU += 1;

    $query = "INSERT INTO users (IDU, mail, login, password) values ('$IDU', '$useremail', '$username', md5('$password'))";
    $result = $conn->query($query);
    if ($result) {
      return true;
    } else {
      return false;
    }
  }

  public function getUsersBooks ($username) {
    global $conn;

    $query = "SELECT books.title, authors.name, theme.theme, books.pages, books.AgeLimit, date(book_user_buy.buy_date) as buydate
    FROM book_user_buy
    INNER JOIN users ON users.IDU = book_user_buy.IDU
    INNER JOIN books ON books.IDB = book_user_buy.IDB
    INNER JOIN book_author_id ON books.IDB = book_author_id.IDB
    INNER JOIN authors ON authors.IDA = book_author_id.IDA
    INNER JOIN book_theme ON book_theme.IDB = books.IDB
    INNER JOIN theme ON theme.IDT = book_theme.IDT
    WHERE users.login='$username'
    GROUP BY title";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()): ?>
      <div class="col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary"><?php echo $row["theme"]?></strong>
            <h3 class="mb-0"><?php echo $row["title"]?></h3>
            <div class="mb-1 text-muted"><?php echo $row["buydate"]?></div>
            <p class="card-text mb-auto"><?php echo $row["name"]?></p>
            <p class="card-text mb-auto"><?php echo $row["pages"]?> стр.</p>
            <p class="card-text mb-auto"><?php echo $row["AgeLimit"]?></p>
            <a href="#" class="stretched-link">Продолжить чтение</a>
          </div>
        </div>
      </div>
      <?php endwhile;
    } else {
      echo "Скорее всего вы ещё ничего не покупали.";
    }
  }

  public function dataToExcel () {
    global $conn;
    $query="SELECT * FROM book_user_buy";
    $result=$conn->query($query);
    // $result=array();
    $filename = "src/Webinfopen.xls"; // File Name
    // Download file
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/vnd.ms-excel");

    $flag = false;
    while ($row = mysqli_fetch_assoc($result)) {
      if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
      }
      echo implode("\t", array_values($row)) . "\r\n";
    }
  }

  public function dataToXML () {
    global $conn;
    $query = "SELECT * FROM book_user_buy";

    $result=$conn->query($query);

    $filename = "src/WebinfopenXML.xml";
    $fd = fopen($filename, 'w') or die("не удалось создать файл");

    fwrite($fd, "<?xml version=\"1.0\"?>\n");
    fwrite($fd,"<purchases>\n");

    while($row=mysqli_fetch_assoc($result))
    {
      fwrite($fd,"\t<purchase>\n");
      fwrite($fd,"\t\t<user_id>".$row["IDU"]."</user_id>\n");
      fwrite($fd,"\t\t<book_id>".$row["IDB"]."</book_id>\n");
      fwrite($fd,"\t\t<buy_date>".$row["buy_date"]."</buy_date>\n");
      fwrite($fd,"\t</purchase>\n");
    }

    fwrite($fd,"</purchases>\n");

    fclose($fd);
  }
}
?>
