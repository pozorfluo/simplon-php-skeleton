<?php

/**
 * 
 */

declare(strict_types=1);

use \Templates\Nav as Nav;
use \Templates\PatientForm as PatientForm;


$page_title = 'add-patient';

require 'src/Templates/Head.php';
?>

<body>

    

    <?php

    /* todo - [ ] Move Nav to a layout */
    $nav = new Nav([
        'Home' => 'Home/Welcome/',
        'Add Patient' => 'Patient/Add/',
        'List Patient' => 'Patient/List/',
        'Profile Patient' => 'Patient/List/'.($id_from_controller_param ?? ''),
    ]);

    $nav->render();
    $add_patient_form = new PatientForm(
        'D' . str_shuffle('ubois') . ' de la M' . str_shuffle('oquette'),
        'Jean-Mi' . str_shuffle('michelou'),
        date('Y-m-d'),
        strval(rand(1111111111, 9999999999)),
        'jean-mi' . strval(rand(11, 999)) . '@caramail.com',
        htmlspecialchars($_SERVER['PHP_SELF'])
    );
    $add_patient_form->render();
    ?>
    <?php require 'src/helper-table.php'; ?>
    <?php require 'src/Templates/Footer.php'; ?>

</body>

</html>