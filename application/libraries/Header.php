<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header{

        public function loadmenu()
        {
        	 $this->load->helper("url");
             $this->load->library('session');
		     $this->load->model('Headermodel');
        try {
           if($this->session->userdata('logged_in'))
           {    
            //$this->load->model('Headermodel');
            $data["menudetails"]=$this->Headermodel->get_menu('0');
            //print_r($data["menudetails"]); 
            $count = count($data["menudetails"]);
            $HTML ='';

           $HTML .= "<ul class='nav navbar-nav'>";
           for($i=0;$i<$count;$i++)
            {
              if($data["menudetails"][$i]->ParentID=="0")
              {                   
                   if($data["menudetails"][$i]->HasChild=="1")
                   {

                    $HTML .= "<li class='menu-dropdown mega-menu-dropdown active'>
                          <a data-hover='megamenu-dropdown' data-close-others='true' data-toggle='dropdown' href='' class='dropdown-toggle'>".$data["menudetails"][$i]->MenuName." <i class='fa fa-angle-down'></i></a>";
                    $data["getchild"] = $this->Headermodel->get_menu($data["menudetails"][$i]->MenuID);
                    $HTML .= "<ul class='dropdown-menu'>"; 
                    $count1 = count($data["getchild"]);
                    for($j=0;$j<$count1;$j++)
                    {
                               $HTML .= "<li><a href='".base_url($data["getchild"][$j]->Url)."''>".$data["getchild"][$j]->MenuName."</a></li>";
                    }
                      $HTML .= "</ul></li>";         

                   }
                   else
                   {
                    $HTML .= "<li><a href='".base_url($data["menudetails"][$i]->Url)."''>".$data["menudetails"][$i]->MenuName."</a></li>";
                   }
               }
            
    
      }
      $HTML .= "<ul>"; 
      $data["HTML"] = $HTML;
      echo "</div>
		</div>
	</div>	
</div> ";      
    }
  }catch (Exception $e) {
    
  }
        }
}
?>