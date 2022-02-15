<?php
include_once('includes/functions_model.php');
include_once('includes/functions_controller.php');
include_once('includes/insert_audit_trail.php');
include_once('includes/functions_email.php');


/*
 * 
 * This is a code generator written in PHP. 
 * Developers need not waste time writing methods for retrieving data, inserting data, updating data, submitting forms etc as this code generates 
 * all that code automatically. 
 * To use this, specify a database table (at the minimum) and run the script to generate code for methods that can be used to manipulate data in the table. 
 */


//Configure the Connection details to the MySQL database
$hostname_conn = "";
$database_conn = "";
$username_conn = "";
$password_conn = "";
$estategenie_conn = @mysql_connect($hostname_conn, $username_conn, $password_conn,$database_cg_conn) or trigger_error(mysql_error(),E_USER_ERROR); 


//Specify the target database and table details here
$the_db_name = "bizfrontal_db";
$the_table_name = "tbl_appointment_bookings";
$the_function = "AppointmentBookings";


@mysql_select_db($database_conn);

@$q_type = mysql_real_escape_string(trim($_GET['type'])); //getter_setter, maker_checker


if(trim(strtoupper($q_type)) == "GETTER_SETTER")
{

echo "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% GETTER, SETTER, QUERY FUNCTIONS FOR DATABASE TABLES ";





$db_func_code_construct1 = "";
$column_names = "";
$column_names_var = "";
$columns_comma_list = "";
$column_names_var2 = "";
$column_names_var3 = "";
$quote = '"';


$query1 = "SELECT `COLUMN_NAME`
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA`='$the_db_name'
    AND `TABLE_NAME`='$the_table_name'";

//echo $query1;
$result1 = mysql_query($query1)
or die ("Table Columbs Check ".mysql_error());
$num_fields = mysql_num_fields($result1);
$data = array();
while ($row = mysql_fetch_array($result1, MYSQL_ASSOC))
{
    //var_dump($row);
    //$db_func_code_construct1 .= "$".$row["COLUMN_NAME"].", ";
    $columns_comma_list .= "".$row["COLUMN_NAME"].",";
    $data[] = $row; //append each table row (fields and field values) to an array called $data
}
$db_func_code_construct1 = rtrim($db_func_code_construct1, ', ');
$columns_comma_list = rtrim($columns_comma_list, ', ');
$columns_array_list = explode(",", $columns_comma_list);




echo "<br><br>======================== INSERT <br><br>";

$the_operation = "insert"; //insert, update, get
$the_function_name = $the_operation."".$the_function;
$exclusion_columns_comma_list = "event_sn,entry_date,entry_time,entry_id";  //specify the column names you want to exclude in this code generation
$exclusion_columns_array = explode(",", $exclusion_columns_comma_list);

$db_func_code_construct1 = "";
$column_names = "";
$column_names_var = "";
$columns_comma_list = "";
$column_names_var2 = "";
$column_names_var3 = "";
$quote = '"';

foreach($columns_array_list as $col)
{
    if( array_search($col, $exclusion_columns_array) === false )
    {
        $column_names .= "".$col.",<br>";
        $column_names_var .= "'$".$col."',<br>";
        $column_names_var2 .= "'$".$col."',";
        $column_names_var3 .= "$".$col.", ";
    }
}
$column_names = rtrim($column_names, ',<br>');
$column_names_var = rtrim($column_names_var, ',<br>');
$column_names_var2 = rtrim($column_names_var2, ',<br>');
$column_names_var3 = rtrim($column_names_var3, ',');
$column_names_var3 = rtrim($column_names_var3, ', ');



echo "function $the_function_name ($column_names_var3";
echo ")<br>";
echo "{";
echo "<br><br>  mysql_query(".$quote." <br>INSERT INTO  $the_table_name  (<br>$column_names)<br>VALUES<br>(<br>$column_names_var)<br> ".$quote.")or die(".$quote." $the_function_name ".$quote.".mysql_error());";
echo "<br> <br> <br> return 'success'; <br><br> }";





echo "<br><br><br><br>======================== UPDATE <br><br>";

$the_operation = "update"; //insert, update, get
$the_update_primary_key_col = "type_id";
$the_function_name = $the_operation."".$the_function;
$exclusion_columns_comma_list = "event_sn,entry_time,apartment_id,building_unit_id,";  //specify the column names you want to exclude in this code generation
$exclusion_columns_array = explode(",", $exclusion_columns_comma_list);
$update_clause_parts = "";


$db_func_code_construct1 = "";
$column_names = "";
$column_names_var = "";
$columns_comma_list = "";
$column_names_var2 = "";
$column_names_var3 = "";
$quote = '"';


foreach($columns_array_list as $col)
{
    if( array_search($col, $exclusion_columns_array) === false )
    {
        $column_names .= "".$col.",<br>";
        $column_names_var .= "'$".$col."',<br>";
        $column_names_var2 .= "'$".$col."',";
        $column_names_var3 .= "$".$col.", ";
        $update_clause_parts .= "$col = '$".$col."',<br>";
    }
}


$column_names = rtrim($column_names, ',<br>');
$column_names_var = rtrim($column_names_var, ',<br>');
$column_names_var2 = rtrim($column_names_var2, ',<br>');
$column_names_var3 = rtrim($column_names_var3, ',');
$column_names_var3 = rtrim($column_names_var3, ', ');
$update_clause_parts = rtrim($update_clause_parts, ',<br>');

echo "function $the_function_name ($column_names_var3";
echo ")<br>";
echo "{";
echo "<br><br>  mysql_query(".$quote." <br>UPDATE  $the_table_name  SET <br>$update_clause_parts WHERE $the_update_primary_key_col = '$".$the_update_primary_key_col."' <br><br>".$quote.")or die(".$quote." $the_function_name ".$quote.".mysql_error());";
echo "<br> <br> <br> return 'success'; <br><br> }";






echo "<br><br><br><br>======================== GET/QUERY <br><br>";

$the_operation = "get"; //insert, update, get
$the_query_filter_columns_comma_list = "";  // if none is specified, then all table columns are made filters
  if(trim($the_query_filter_columns_comma_list) == "")
  {
      $the_query_filter_columns_comma_list = $column_names_var3;
  }
  else
  {
    $the_query_filter_columns_array = explode(",", $the_query_filter_columns_comma_list);
  }
    
$the_function_name = $the_operation."".$the_function;
$exclusion_columns_comma_list = "description,comment,created_on,created_by";  //specify the column names you want to exclude in this code generation
$exclusion_columns_array = explode(",", $exclusion_columns_comma_list);
$update_clause_parts = "";
$query_var = "$"."query1";
$result_var = "$"."result1";
$darray_var = "$"."data[]";
$row_var = "$"."row";
$num_fields_var = "$"."num_fields";
$data_var = "$"."data";

$db_func_code_construct1 = "";
$column_names = "";
$column_names_var = "";
$columns_comma_list = "";
$column_names_var2 = "";
$column_names_var3 = "";
$quote = '"';
$filter_code = "";
$blank = "";
$query_clause = "";
$colums_array_filters = array();


if(count($the_query_filter_columns_array) > 0)
{
    $colums_array_filters = null;
    $colums_array_filters = $the_query_filter_columns_array;

}
else 
{
    $colums_array_filters = $columns_array_list;
}


    foreach($colums_array_filters as $col)
    {
        if(!in_array($col, $exclusion_columns_array))
        {
        
            $column_names .= "".trim($col).",<br>";
            $column_names_var .= "'$".trim($col)."',<br>";
            $column_names_var2 .= "'$".trim($col)."',";
            $column_names_var3 .= "$".trim($col).", ";
            $update_clause_parts .= "$col = '$".trim($col)."',<br>";
            $clause = "$$col".$blank."_clause = ".$quote." AND $col = '$$col' ".$quote."";
            
            
            $filter_code .= " <br><br>if((trim($$col) == ''))
                	<br>{
                	<br>  $$col".$blank."_clause = '';	
                	<br>}
                	<br>else
                	<br>{
                	<br>  $clause;
                	<br>}";
        
            //echo "RRRRRRRRRRRRRRRR $clause ||";
            $query_clause .= "$$col".$blank."_clause    ";
        }
    }


$column_names = rtrim($column_names, ',<br>');
$column_names_var = rtrim($column_names_var, ',<br>');
$column_names_var2 = rtrim($column_names_var2, ',<br>');
$column_names_var3 = rtrim($column_names_var3, ',');
$column_names_var3 = rtrim($column_names_var3, ', ');

$update_clause_parts = rtrim($update_clause_parts, ',<br>');


echo "function $the_function_name ($column_names_var3";
echo ")<br>";
echo "{";
echo "$filter_code";
echo "<br><br>  $query_var = ".$quote." SELECT * FROM  $the_table_name WHERE 1=1 $query_clause".$quote.";";
echo "<br><br><br>$result_var = mysql_query($query_var)
		or die ('query1'.mysql_error());
		<br>$num_fields_var = mysql_num_fields($result_var);
		<br>$data_var = array();
		
		<br>while ($row_var = mysql_fetch_array($result_var, MYSQL_ASSOC))
		<br>{
		  
			<br>$darray_var = $row_var; //append each table row (fields and field values) to an array called $data_var <br>
		}
		<br><br>
	
	return $data_var;";
echo "<br> <br><br> }";





echo "<br><br><br><br>=====================================  FORM FOR SUBMISSION TO DATABASE <br><br>";

$the_operation = "update"; //insert, update, get
$the_update_primary_key_col = "invoice_no";
$the_function_name = $the_operation."".$the_function;
$exclusion_columns_comma_list = "";  //specify the column names you want to exclude in this code generation
$exclusion_columns_array = explode(",", $exclusion_columns_comma_list);
$update_clause_parts = "";


$db_func_code_construct1 = "";
$column_names = "";
$column_names_var = "";
$columns_comma_list = "";
$column_names_var2 = "";
$column_names_var3 = "";
$column_names_var4 = "";
$quote = '"';
$html_construct = "";
$httml_div_row = "";
$no_elements_per_row = 3;
$post_var =  "$"."_POST['$".$col."']";



echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ POST FIELDS<br>";

foreach($columns_array_list as $col)
{
    if( array_search($col, $exclusion_columns_array) === false )
    {
        $post_var =  "$"."_POST['".$col."']";
        echo " $".$col." = mysql_real_escape_string(trim($post_var));<br>";
         
    }
}
echo "<br><br><br><br>";



echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ EDIT DETAILS FETCH<br>";

echo "<br><br>";
echo "if($"."q_action == 'e')
	 <br>{<br><br>";
$fetch_details_var = "$"."fetchDetails";
$the_var = "the_";

echo "$fetch_details_var = get".$the_function."(xxxxxxxxx); <br>";

foreach($columns_array_list as $col)
{
    if( array_search($col, $exclusion_columns_array) === false )
    {
        $fetch_details_var =  "$"."fetchDetails[0]['".$col."']";
        echo "$".$the_var."".$col." =  $"."fetchDetails[0]['".$col."'];<br>";
        
    }
}

echo "$"."label = 'Update';";
echo "$"."action = 'update';";
echo "<br> }";
echo "<br><br><br><br>";




echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ FORM HTML (check 'View Source')<br>";

$html_construct .=  '<form name="form_add_apartment" action="'.$_SERVER['PHP_SELF'].'" method="post">
    
    
                                     <input type="hidden" name="hidden_action" id="hidden_action" value="<?php echo $action; ?>">
                                     <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $q_id; ?>">';


$i = 1;
foreach($columns_array_list as $col)
{
        if( array_search($col, $exclusion_columns_array) === false )
        {
                $column_names .= "".trim($col).",<br>";
                $column_names_var .= "'$".trim($col)."',<br>";
                $column_names_var2 .= "'$".trim($col)."',";
                $column_names_var3 .= "$".trim($col).",";
                $update_clause_parts .= "$col = '$".trim($col)."',<br>";
                $clause = "$$col".$blank."_clause = ".$quote." AND $col = '$$col' ".$quote."";
                
                $label_formatted = str_replace("_", " ", $col);
                $label_formatted = ucwords($label_formatted);
                
                if($i == 1)
                {
                    $html_construct .= '<div class="row" id="">';
                }
                $html_construct .= '  <div class="col-xs-4">
                                                        <label>*'.$label_formatted.':</label>
                                                        <input type="text" name="'.$col.'" autocomplete="off"  id="'.$col.'" class="form-control" size="10" value="<?php if($q_action =="e"){echo $the_'.$col.';} ?>"  />
                                                    </div>
                                                      ';
                if($i == $no_elements_per_row )
                {
                    $html_construct .= '</div><br>';
                    $i = 0;
                }
        
                $i++;
        }
    
}
$html_construct .=  "</form>";

$column_names = rtrim($column_names, ',<br>');
$column_names_var = rtrim($column_names_var, ',<br>');
$column_names_var2 = rtrim($column_names_var2, ',<br>');
$column_names_var3 = rtrim($column_names_var3, ',');
$update_clause_parts = rtrim($update_clause_parts, ',<br>');

echo $html_construct;


}




?>