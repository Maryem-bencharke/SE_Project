<?php
interface NurseDAO{
    public function getNurse($Username, $Password);
    public function getNurseById($id);
    public function updateNurse($nurse);
    public function deleteNurse($id);
    public function addNurse($nurse);
}
?>