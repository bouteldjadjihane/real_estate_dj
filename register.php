<?php session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="css/main.css">
  <link rel="website icon" type="png"
  href="img/build4.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="css/reals.css">
  <link rel="stylesheet" href="css/normalize.css"/>
  <link rel="stylesheet" href="css/all.min.css"/>
  <link rel="preconnect" href="https://font.gstatic.com" />
</head>
<body>
<header>
            <nav class="navbar navbar-expand-lg " style="background-color: whitesmoke; top: 0px; position: fixed; width: 100%; height: 70px;z-index: 999;">
                <div class="container-fluid">
                    <div class="main-logo" style="padding-left: 50px;">
                        <img id="logopic" src="img/build4.png" alt="logopic" >
                        <h1 id="logo">RealEstate</h1>
                         </div>
                  <div class="navbar-brand" href="#" style="padding-right: 300px; padding-left: 150px; color: rgb(15, 15, 72);"> </div>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html" style="color: black;" >Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#" style="color: black;">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#" style="color: black;">Pricing</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                       
                      </li>
                      
                    </ul>
                  </div>
                </div>
              </nav></header><br/>
<div class="main">

<h1>Register</h1>
<i>it's very easy</i>
<br/>

<form action="register_post.php" method="POST" > <!-- kolch yroh lel register_post beh nt7a9o les infos s7a7 -->

<?php if(isset($user_error)){
    echo $user_error;
}  
 ?>

<input type="text" name="username" id="username" placeholder="username"><br/>

<?php if(isset($email_error)){
    echo $email_error;
}  
 ?>
<input type="email" name="email" id="email" placeholder=" email " ><br/>

<?php if(isset($pass_error)){
    echo $pass_error;
}  
 ?>

<input type="password" name="password" id="password" placeholder="new password"><br/>

<h7>Gender</h7> 
<?php if(isset($gender_error)){
    echo $gender_error;
}  
 ?>
<select name="gender" title="gender choose male or femail">
<option disabled selected>choose</option>
<option id="male">male</option>
<option id="female">female</option>
</select><br/><br/>

<h7>Birthday</h7>

<?php if(isset($birthday_error)){
    echo $birthday_error;
}  
 ?>
<select aria-label="Jour" name="birthday_day" id="day" title="Jour" class="_9407 _5dba _9hk6 _8esg"><option disabled selected>day</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
<select aria-label="Mois" name="birthday_month" id="month" title="Mois" class="_9407 _5dba _9hk6 _8esg"><option disabled selected>month</option><option value="1">jan</option><option value="2">fév</option><option value="3" >mar</option><option value="4">avr</option><option value="5">mai</option><option value="6">jun</option><option value="7">juil</option><option value="8">août</option><option value="9">sep</option><option value="10">oct</option><option value="11">nov</option><option value="12">déc</option></select>
<select aria-label="Année" name="birthday_year" id="year" title="Année">
  <option disabled selected>year</option><option value="2023" >2023</option><option value="2022">2022</option><option value="2021">2021</option><option value="2020">2020</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option></select>
<br/>
<input type="submit" name="submit" id="submit" value="Register" >
<input type="hidden" name="property_id" value="<?php if (isset( $_SESSION['property_id'])) {
  echo $_SESSION['property_id'];
} ?>">
<input type="hidden" name="property_owner" value="<?php if (isset( $_SESSION['property_owner'])) {
  echo $_SESSION['property_owner'];
} ?>">
<input type="hidden" name="start_date" value="<?php if (isset( $_SESSION['start_date'])) {
  echo $_SESSION['start_date'];
} ?>">
<input type="hidden" name="end_date" value="<?php if (isset( $_SESSION['end_date'])) {
  echo $_SESSION['end_date'];
} ?>">
<input type="hidden" name="offer" value="<?php if (isset($_COOKIE['offer'])) {
  echo $_COOKIE['offer']; 
} ?>">
</form>
<h3>Or</h3>
<a id="login" href="index.php">login</a>
</div>
</body>
</html>
