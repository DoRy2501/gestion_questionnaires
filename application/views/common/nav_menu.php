<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Test the pattern to find the active page
 * @param $pattern = related tab
 */
function test_regex($pattern)
{
    $subject = $_SERVER['REQUEST_URI'];

    if (preg_match($pattern, $subject)) {
        echo "class='active'";
    }
}
/**
 * Test of the current active page
 * @param $page =
 * 1 => Questionnaire
 * 2 => Question
 * 3 => Module
 * 4 => Topic
 * **/
function checkactive($page){
    switch ($page){
        case 0;
            test_regex('/\/Home/');
            test_regex('/\//');
            break;
        case 1;
            test_regex('/\/Questionnaire/');
            break;
        case 2:
            test_regex('/\/(Question[^n]|Question$)/');
            break;
        case 3:
            test_regex('/\/Module/');
            break;
        case 4:
            test_regex('/\/Topic/');
            break;
        case 5:
            test_regex('/\/Admin/');
            break;
        case 6:
            test_regex('/\/Support/');
            break;
        default:
            break;
    }
}

// Display nav menu only if user is logged in
if(isset($_SESSION['logged_in']) && ($_SESSION['logged_in']==TRUE))
{
?>
    <div id="myNavbar" class="container">
        <ul class="nav navbar-nav">
            <?php if($_SESSION['user_access'] >= ACCESS_LVL_MANAGER) { ?>
                <li <?php checkactive(1); ?>><a href="<?php echo base_url('Questionnaire');?>">
                    <?= $this->lang->line('nav_questionnaire');?></a></li>
                <li <?php checkactive(2); ?>><a href="<?php echo base_url('Question');?>">
                    <?= $this->lang->line('nav_question');?></a></li>
                <li <?php checkactive(4); ?>><a href="<?php echo base_url('Topic');?>">
                    <?= $this->lang->line('nav_topic');?></a></li>
                <?php if($_SESSION['user_access'] >= ACCESS_LVL_ADMIN) { ?>
                    <li <?php checkactive(5); ?>><a href="<?php echo base_url('Admin');?>">
                        <?= $this->lang->line('nav_admin');?></a></li>
                <?php } ?>
                
            <?php } else { ?>
                <li <?php checkactive(0); ?>><a href="<?php echo base_url('Home');?>">
                    <?php echo $this->lang->line('nav_home');?></a></li>
           <?php } ?>
        </ul>
        
        <!-- Button to submit a problem -->
        <?php if($_SESSION['user_access'] >= ACCESS_LVL_MANAGER) { ?>
            <a class="btn btn-warning pull-right" href="<?php echo base_url('Support');?>">
                    <?= $this->lang->line('nav_support');?></a>
        <?php } ?>
    </div>
<?php } ?>
