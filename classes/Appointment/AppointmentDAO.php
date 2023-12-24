<?php
interface AppointmentDAO {
    public function createAppointment($appointment);
    public function readAppointment($appointmentId);
    public function updateAppointment($appointment);
    public function deleteAppointment($appointmentId);
}

?> 
