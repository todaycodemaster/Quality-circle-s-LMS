<style>
    body{
        background-image: none !important;
        background-color: white;
    }
    .table-border-th{
        border-bottom: 1px solid #B7BCB7 !important;
    }
    .table-border-td{
        border-bottom: 1px solid #E9EBE9 !important;
        width:25% !important;
    }
    div>i{
        font-size: 0px;
    }
</style>
<header class="page-header">
    <h2><?=$term["exammanagement"]?></h2>
    <h5 style="text-align: right; margin-right: 10px"><a href="javascript:pagePrint()" class="btn btn-primary ml-3"><i class="fas fa-print"></i> Print and Download</a></h5>
</header>

<main role="main" class="content-body">

<?php if($certificate['certificate_id'] == 1) {?>
<table align="center">
<tr><td colspan="3"><img src="<?php echo base_url().'assets/certificate/' ?>header.jpg" /></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo strtoupper($certificate['COMPANY NAME']);?></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Hereby Certifies</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">That</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><i><?php echo strtoupper($certificate['PARTICIPANT NAME']);?></i></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Has Successfully Completed</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo strtoupper($certificate['COURSE NAME']);?></td></tr>
<tr><td style="font-size:18px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Given on</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo strtoupper($certificate['CERTIFICATION DATE']);?></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">in</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo $certificate['LOCATION'];?></td></tr>
<tr>
<td width="100">&nbsp;</td>
<td width="100" style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45"><?php echo strtoupper($certificate['NUMBER']);?> CEU</td>
<td align="right" width="100"><?php echo $certificate['SIGNATURE']; ?></td>
</tr>
<tr>
<td style="font-size:15px;font-family:tahoma;" align="center">5001 <br />Certificate Number</td>
<td style="font-size:15px;font-family:tahoma;" align="center"><?php echo date_format(date_create($certificate['CERTIFICATION DATE']),"M d, Y")?> <br />Certificate Date</td>
<td style="font-size:15px;font-family:tahoma;" align="center"><?php echo($certificate['CATEGORY']);?></td>
</tr>
<tr><td colspan="3"><img src="<?php echo base_url().'assets/certificate/' ?>footer.jpg" /></td></tr>
</table>
<?php } elseif($certificate['certificate_id'] == 2){?>
<table align="center">
<tr><td colspan="3"><img src="<?php echo base_url().'assets/certificate/' ?>header.jpg" /></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Quality Circle International Limied</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Hereby Certifies</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">That</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><i><?php echo strtoupper($certificate['PARTICIPANT NAME']);?></i></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Has Successfully Completed</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo strtoupper($certificate['COURSE NAME']);?></td></tr>
<tr><td style="font-size:18px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">Given on</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo date_format(date_create($certificate['CERTIFICATION DATE']),"M d, Y")?></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3">in</td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo $certificate['LOCATION'];?></td></tr>
<tr><td style="font-size:23px;font-weight:500;font-family:tahoma;" align="center" height="45" colspan="3"><?php echo strtoupper($certificate['NUMBER']);?> CEU</td></tr>
<tr>
<td style="font-size:15px;font-family:tahoma;" align="center">5001 <br />Certificate Number</td>
<td style="font-size:15px;font-family:tahoma;" align="center"><?php echo date_format(date_create($certificate['CERTIFICATION DATE']),"M d, Y")?> <br />Certificate Date</td>
<td style="font-size:15px;font-family:tahoma;" align="center"><?php echo($certificate['CATEGORY']);?></td>
</tr>
<tr><td colspan="3"><img src="<?php echo base_url().'assets/certificate/' ?>footer.jpg" /></td></tr>
</table>
<?php } ?>
</main>

<div>
    <form id="print_form" method="POST" action="<?= base_url()?>admin/demand/print_exam_certificate">
        <input type="hidden" id="content" name="content">
    </form>
</div>
<script>
    var baseurl = "<?php echo base_url(); ?>";
    $(function(){
        if(!$("html").hasClass("sidebar-left-collapsed"))
        {
            $("html").addClass("sidebar-left-collapsed");
            $("html").removeClass("sidebar-left-opened");
        }
    });

    /*function pagePrint() {
       
        var content = $('.content-body').html();
        // alert(content); 
        $('#content').val(content);
        $('#print_form').submit(); 

        $.ajax({
            url: "<?= base_url()?>admin/demand/print_exam_certificate",
            type: 'POST',
            data: { content: content },  
            success: function(data, status, xhr){
              new PNotify({
                  title: 'Success',
                  text: 'Certificate Print and Download',
                  type: 'success'
              });               
            },
            error: function(){ 
                new PNotify({
                    title: 'Error',
                    text: 'Failed!',
                    type: 'error'
                });
            }
        }); 
    }*/
	
    function pagePrint() {
        var newWin = window.open();
        newWin.focus();
        newWin.document.write($('.content-body').html());
        newWin.print();
        newWin.close();
        
    }

    $(document).ready(function() {
        $("*[contenteditable=true]").attr("contenteditable",false);
    });
</script>       

<script src="<?php echo base_url(); ?>assets/js/user.js"></script>