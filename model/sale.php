<?php
include_once __DIR__ . '/../vendor/database/database.php';
class sale
{
    public function getuserInfo($id)
    {
        $connect = database::connect();
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * FROM sale WHERE user_id = :id'; // Use :id as a placeholder
        $state = $connect->prepare($sql);
        $state->bindParam(':id', $id, PDO::PARAM_INT); // Bind the parameter

        $result = null; // Initialize the result variable

        if ($state->execute()) {
            $result = $state->fetch(PDO::FETCH_ASSOC);
        }

        return $result;
    }

}
?>
