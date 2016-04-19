<?
class Database {
	//-----DB params------
	private $dns;
	private $user;
	private $password;
	
	//------***----------
   public $connection;

   public function __construct($dns,$user,$password) {
	$this->dns = $dns;
	$this->user = $user;
	$this->password = $password;
		try {
			$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			); 
			$this->connection = new PDO($this->dns, $this->user, $this->password, $options);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
   }
}
?>