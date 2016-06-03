<?php  
ob_start();
class ExcelImportComponent extends Component { 
	
	function excel_to_array($file) { 
		
                
                
                App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel'.DS.'PHPExcel.php'));
                App::import('Vendor', 'PHPExcel_IOFactory', array('file' => 'PHPExcel'.DS.'PHPExcel'.DS.'IOFactory.php'));
   
		
		$fileType = PHPExcel_IOFactory::identify($file);
               
                
                if($fileType=="Excel5" || $fileType=="Excel2007"){
		
                $objReader = PHPExcel_IOFactory::createReader($fileType);
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($file);
		
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		unset($sheetData[1]);
		
		
		$resultArray = array();
	
		$i = 0;
                
                $applo_hosp_count = 1;
                
                $express_clinic_count = 1;
                
                $test_categoty_tmp = '';
		
                    if(count($sheetData)>0){
               
			foreach($sheetData as $k=>$val) {
                       
                            
                        $test_category_name = trim($val['A']);
                        //$test_category_name = ucwords(strtolower($test_category_name));
                        
                        if($test_category_name==""){
                            $test_category_name = $test_categoty_tmp;
                        }else{
                            $test_categoty_tmp = $test_category_name;
                        }
                       
                        
			$resultArray[$i]['TestCategory'] = $test_category_name;
                        $test_type = trim($val['B']);
                        
                        if(strtolower($test_type)=='lab'){
                            $resultArray[$i]['TestType'] = 1;
                        }else if(strtolower($test_type)=='radiology'){
                            $resultArray[$i]['TestType'] = 2;
                        }
                        
                        $test_name = trim($val['C']);
                        //$test_name = ucwords(strtolower($test_name));
                        
			$resultArray[$i]['TestName'] = $test_name;
			
                        
                        $excel_home_collection = strtolower(trim($val['D']));
                        if($excel_home_collection=='yes' || $excel_home_collection=='y'){
                            $resultArray[$i]['HomeCollection'] = 1;
                        }else{
                            $resultArray[$i]['HomeCollection'] = 0;
                        }
                        
                        $resultArray[$i]['SeoTags'] = trim($val['E']);
                        
			$clinic_name = trim($val['F']);
                        
                        $resultArray[$i]['ClinicName'] = $clinic_name;
                        
                        $clinic_area = trim($val['G']);
                        
                        if($clinic_name=='Apollo Hospital'){
                            
                            if($clinic_area==""){
                                
                                $appolo_count_mode = $applo_hosp_count%2;
                                
                                if($appolo_count_mode==1){
                                    $clinic_area = 'Bannerghatta Road';
                                }
                                if($appolo_count_mode==0){
                                    $clinic_area = 'Jayanagar';
                                }
                              
                            }
                            $applo_hosp_count++;  
                            
                        }
                        
                        if($clinic_name=='Express Clinics'){
                           
                            if($clinic_area==""){
                                
                                $express_count_mode = $express_clinic_count%6;
                                
                                if($express_count_mode==1){
                                    $clinic_area = 'HSR Layout';
                                }
                                else if($express_count_mode==2){
                                    $clinic_area = 'Koramangala';
                                }
                                else if($express_count_mode==3){
                                    $clinic_area = 'Jayanagar';
                                }
                                else if($express_count_mode==4){
                                    $clinic_area = 'Marathahalli';
                                }
                                else if($express_count_mode==5){
                                    $clinic_area = 'Kalyan Nagar';
                                }
                                else if($express_count_mode==0){
                                    $clinic_area = 'Vyalikaval';
                                }
                              
                            }
                            $express_clinic_count++;  
                            
                        }
                        
                        if($clinic_name=='Vikram Hospital'){
                            $clinic_area = 'Vasanthnagar';
                        }
                        
                        if($clinic_name=='Raghav Diagnostics'){
                            $clinic_area = 'Jayanagar';
                        }
                        /*if($clinic_name=='Elbit Diagnostics'){
                            $clinic_area = 'Vasanthnagar';
                        }*/
                        if($clinic_name=='Central Lab'){
                            $clinic_area = 'Richmond Road';
                        }
                        if($clinic_name=='Veritas Diagnostics'){
                            $clinic_area = 'Jayamahal Extension';
                        }
                        
                        if($clinic_name=='Isha Diagnostics'){
                            $clinic_area = 'Malleshwaram';
                        }
                        
                        $resultArray[$i]['ClinicArea'] = $clinic_area;
                        
                        $resultArray[$i]['ActualPrice'] = trim($val['H']);
			$resultArray[$i]['OfferPrice'] = trim($val['I']);
                        
                        $resultArray[$i]['Errors'] = '';
                        $resultArray[$i]['CreatedStatus'] = 'False';
			$i++;
			}
			
                    }
                    
                    //debug($resultArray);
                    //exit;
		
                    return $resultArray;
                
                
                }else{
                    echo "File Type not supporting";
                    exit;
                    
                }
	
		
	} 
        
        
        function package_excel_to_array($file) { 
		
                
                
                App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel'.DS.'PHPExcel.php'));
                App::import('Vendor', 'PHPExcel_IOFactory', array('file' => 'PHPExcel'.DS.'PHPExcel'.DS.'IOFactory.php'));
   
		
		$fileType = PHPExcel_IOFactory::identify($file);
               
                
                if($fileType=="Excel5" || $fileType=="Excel2007"){
		
                $objReader = PHPExcel_IOFactory::createReader($fileType);
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($file);
		
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		unset($sheetData[1]);
		
		
		$resultArray = array();
	
		$i = 0;
                
                $applo_hosp_count = 1;
                
                $tests_included_orginal_count = '';
            
                $package_name_tmp = '';
                
                $clinic_name_tmp = '';
                
                $mon_fri_tmp = '';
                
                $saturday_tmp= '';
                
                $sunday_tmp= '';
                
                $append_test_included = '';
		
                    if(count($sheetData)>0){
               
			foreach($sheetData as $k=>$val) {
                       
                        if(trim($val['B']!="")){
                        
                            
                        $test_package_name = trim($val['A']);
                        
                       
                        $package_name_tmp = $test_package_name;
                        
                        $resultArray[$i]['PackageName'] = $test_package_name;
                        
                        $tests_included = trim($val['B']);
                        
                        
                        
                        if($package_name_tmp==""){
                            
                            $append_test_included.='###'.$tests_included;
                             
                            
                        }else{
                            $append_test_included = $tests_included;
                        }
                       
                        $resultArray[$i]['TestsIncluded'] = $append_test_included;
                        
                        
                        $clinic_name = trim($val['D']);
                        
                       
                        $resultArray[$i]['ClinicName'] = $clinic_name;
                        
                        $resultArray[$i]['ActualPrice'] = trim($val['I']);
                        
			$resultArray[$i]['OfferPrice'] = trim($val['J']);
                        
                        $resultArray[$i]['Categories'] = trim($val['O']);
                        
                        $mon_fri = trim($val['P']);
                        
                        
                        
                        if($mon_fri==""){
                            $mon_fri = $mon_fri_tmp;
                        }else{
                            $mon_fri_tmp = $mon_fri;
                        }
                       
                        
			$resultArray[$i]['MonFri'] = $mon_fri_tmp;
                        
                        
                        
                        $saturday= trim($val['Q']);
                        
                        if($saturday==""){
                            $saturday = $saturday_tmp;
                        }else{
                            $saturday_tmp = $saturday;
                        }
                        
                        $resultArray[$i]['Saturday'] = $saturday;
                        
                        $sunday = trim($val['R']);
                        
                        if($sunday==""){
                            $sunday = $sunday_tmp;
                        }else{
                            $sunday_tmp = $sunday;
                        }
                        
                        
                        $resultArray[$i]['Sunday'] = $sunday;
                        
                       
                        $clinic_area = "";
                        
                        if($clinic_name=='Apollo Hospital'){
                            $clinic_area = 'Bannerghatta Road';
                        }
                        
                        /*
                        if($clinic_name=='Apollo Hospital'){
                            
                            if($clinic_area==""){
                                
                                $appolo_count_mode = $applo_hosp_count%2;
                                
                                if($appolo_count_mode==1){
                                    $clinic_area = 'Bannerghatta Road';
                                }
                                if($appolo_count_mode==0){
                                    $clinic_area = 'Jayanagar';
                                }
                              
                            }
                            $applo_hosp_count++;  
                            
                        }*/
                        
                        if($clinic_name=='Express Clinics'){
                            $clinic_area = 'HSR Layout';
                        }
                        
                        /*
                        if($clinic_name=='Express Clinics'){
                           
                            if($clinic_area==""){
                                
                                $express_count_mode = $express_clinic_count%6;
                                
                                if($express_count_mode==1){
                                    $clinic_area = 'HSR Layout';
                                }
                                else if($express_count_mode==2){
                                    $clinic_area = 'Koramangala';
                                }
                                else if($express_count_mode==3){
                                    $clinic_area = 'Jayanagar';
                                }
                                else if($express_count_mode==4){
                                    $clinic_area = 'Marathahalli';
                                }
                                else if($express_count_mode==5){
                                    $clinic_area = 'Kalyan Nagar';
                                }
                                else if($express_count_mode==0){
                                    $clinic_area = 'Vyalikaval';
                                }
                              
                            }
                            $express_clinic_count++;  
                            
                        }*/
                        
                        if($clinic_name=='Vikram Hospital'){
                            $clinic_area = 'Vasanthnagar';
                        }
                        
                        if($clinic_name=='Raghav Diagnostics'){
                            $clinic_area = 'Jayanagar';
                        }
                        if($clinic_name=='Elbit Diagnostics'){
                            $clinic_area = 'Vasanthnagar';
                        }
                        if($clinic_name=='Central Lab'){
                            $clinic_area = 'Richmond Road';
                        }
                        if($clinic_name=='Veritas Diagnostics'){
                            $clinic_area = 'Jayamahal Extension';
                        }
                        
                        $resultArray[$i]['ClinicArea'] = $clinic_area;
                        
                        
                        $resultArray[$i]['Errors'] = '';
			$i++;
			}
                        }
                    }
		
                    //debug($resultArray);
                    
                    $key_item = '';
                    
                    foreach($resultArray as $k=>$item){
                        
                        
                        
                        if($item['PackageName']!=""){
                            $key_item = $k;
                           
                        }
                        
                        
                        
                        if($item['PackageName']=="" && $item['TestsIncluded']!=""){
                            
                            $append_test_included = $item['TestsIncluded'];
                            
                            
                            $resultArray[$key_item]['TestsIncluded']= $append_test_included;
                            
                            unset($resultArray[$k]);
                        }
                        
                    }
                    
                    
                    
                    
                    $resultArrayNew = array();
                    
                    foreach($resultArray as $k=>$item){
                        
                        $resultArrayNew[] = $item;
                      
                        
                    }
                    
                  
                    
                    foreach($resultArrayNew as $key=>$item){
                        
                       $clinic_name = $item['ClinicName'];
                        if($clinic_name=="Apollo Hospital"){
                            
                            $count = count($resultArrayNew);
                            $item['ClinicArea'] = 'Jayanagar';
                            $resultArrayNew[$count] = $item;
                        
                        }
                    }
                    
                    return $resultArrayNew;
                
                
                }else{
                    echo "File Type not supporting";
                    exit;
                    
                }
	
		
	} 
        
        
} 

?>


