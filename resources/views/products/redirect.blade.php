@extends('layouts.master_auth')
 
@section('content')
<?php 
		$merchant_data='45990';
		$working_key='CB669E2A86DB6C47DE75F6362C8D7ACB';//Shared by CCAVENUES
		$access_code='AVND03HD40AZ34DNZA';//Shared by CCAVENUES
?>
<form method="post" name="redirect" action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
<script language='javascript'>document.redirect.submit();</script>
@endsection
