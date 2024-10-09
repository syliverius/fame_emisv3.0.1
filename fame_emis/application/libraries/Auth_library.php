<?php 

class Auth_library{

	public function is_secure($employee_id, $module_name, $allowed_modules) {
    $url = base_url();
    if ($employee_id !== '') {
        $moduleNames = array_map(function ($module) {
            return $module->name;
        }, $allowed_modules);

        if (in_array($module_name, $moduleNames)) {
            return true;
        } else {
            echo "<script>
            	alert('Ooops!! You don\\'t have permission to access this menu'); window.history.back();
            	</script>";
        }
    } else {
        echo "<script>
	        alert('Ooops!! You are not logged in'); window.location='$url';
	        </script>";
    }
}



}

?>