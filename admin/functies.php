<?php 
function removeMessage($id)
    {

    $dQuery = "DELETE FROM content
               WHERE id = '". (int) $id ."'
               ";

    $delete = mysql_query($dQuery);
    if($delete === false)
        { 
    throw new Exception ('FOUT: kan bericht niet verwijderen');
        return false;
        }    
    else
         {
          
        return true;
        header('refresh: 2;');
        }
    }


try 
{ 
  $delete;

}
catch (Exception $e)
{
    echo $e->getMessage();
}

function updateMessage ($id)
	{
		$uQuery = "SELECT 
							bericht
					FROM
							content
					WHERE
							id = '" . (int) $id . "' 
					";

					$edit = mysql_query($uQuery);
					if($edit === false)
						{
							throw new Exception ('FOUT: kan bericht niet ophalen');
							return false;
						} 
					else
						{
							return true;
						} 
	}

	try 
	{
		$edit
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
?>