<?php
class format
{
	public function formatdate($date)
	{
		return date('F j, Y,g:i a', strtotime($date));
	}
	public function textshorten($text, $limit = 500)
	{
		$text = $text . " ";
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, strrpos($text, ' '));
		$text = $text . "....";
		return $text;
	}

	public function validation($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	public function title()
	{
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path, '.php');
		if ($title == 'index') {
			$title = 'Home';
		} elseif ($title == 'contact') {
			$title = 'Contact';
		}
		return $title = ucfirst($title);
	}
}
