function comprobar_form_serial(date, re_date){
    
    $$('.error').invoke('hide');

    if (comprobar_date(date, re_date)){
	$('error_date').show();
	new Effect.Opacity('serial_save_error', {duration:3.0, from:1.0, to:0.0});
	return false;
    }

    return true;  
}

function comprobar_form_mm(date1, date2, re_date){
    $$('.error').invoke('hide');

    if (comprobar_date(date1, re_date)){
	$('error_date1').show();
	new Effect.Opacity('mm_save_error', {duration:3.0, from:1.0, to:0.0});
	return false;
    }

    if (comprobar_date(date2, re_date)){
	$('error_date2').show();
	new Effect.Opacity('mm_save_error', {duration:3.0, from:1.0, to:0.0});
	return false;
    }

    return true;  
}

function dmy2ymd(date){
  var fecha = date.strip(); // prototype trim
  var separa = fecha.split(" ");
  var parts = separa[0].split("/");
  var ymd = parts[2] + '/' + parts[1] + '/'+parts[0];
  if (separa.length > 1){
    ymd += ' ' + separa[1];
  }
  
  return ymd;
}

function comprobar_form_pub(checked1, start1, end1, checked2, start2, end2, re_date){
    $$('.error').invoke('hide');

    if (checked1){
        if (comprobar_date(start1, re_date)){
        $('error_start1').show();
        new Effect.Opacity('mm_save_error', {duration:3.0, from:1.0, to:0.0});
        return false;
        }

        if (comprobar_date(end1, re_date)){
        $('error_end1').show();
        new Effect.Opacity('mm_save_error', {duration:3.0, from:1.0, to:0.0});
        return false;
        }
        var dstart1 = new Date(Date.parse(dmy2ymd(start1)));
        var dend1   = new Date(Date.parse(dmy2ymd(end1)));
        if (dstart1 > dend1){
        new Effect.Opacity('mm_save_error', {duration:3.0, from:1.0, to:0.0});
        return false;  
        }
    }

    if (checked2){
        if (comprobar_date(start2, re_date)){
        $('error_start2').show();
        new Effect.Opacity('mm_save_error', {duration:3.0, from:1.0, to:0.0});
        return false;
        }

        if (comprobar_date(end2, re_date)){
        $('error_end2').show();
        new Effect.Opacity('mm_save_error', {duration:3.0, from:1.0, to:0.0});
        return false;
        }

        var dstart2 = new Date(Date.parse(dmy2ymd(start2)));
        var dend2   = new Date(Date.parse(dmy2ymd(end2)));
        if (dstart2 > dend2){
        new Effect.Opacity('mm_save_error', {duration:3.0, from:1.0, to:0.0});
        return false;  
        }
    }

    return true;
}

function comprobar_form_pass(){
  var ps1 = $('pass1');
  var ps2 = $('pass2');
  if ( $('broadcast_id').value == 2 ) {
    if ( (ps1.value != ps2.value) || ps1.value == '') {
      return false;
    } else {
      return true;
    }
  } else {
    return true;
  }
}
function comprobar_form_person(email, url){
    
    $$('.error').invoke('hide');

    if ((email != "")&&(comprobar_email(email))){
	$('error_email').show();
	return false;
    }

    if ((url != "")&&(comprobar_url(url))){
	$('error_url').show();
	return false;
    }

    Modalbox.hide();
    return true;  
}


function comprobar_form_url(url){
    
    $$('.error').invoke('hide');

    if (comprobar_url_gen(url)){
	$('error_url').show();
	return false;
    }
    Modalbox.hide();
    return true;  
}

function comprobar_form_file_nmb(file){
    
    $$('.error').invoke('hide');

    if (file == ""){
	$('error_file').show();
	return false;
    }
    return true;  
}


function comprobar_form_place(coorgeo){
    
    $$('.error').invoke('hide');

    if ((coorgeo != "")&&(comprobar_coorgeo(coorgeo))){
	$('error_coorgeo').show();
	return false;
    }

    Modalbox.hide();
    return true;  
}


function comprobar_form_user(login, password, email){
    
    $$('.error').invoke('hide');

    if (login == ""){
	$('error_login').show();
	return false;
    }
    if (password == ""){
	$('error_password').show();
	return false;
    }
    if ((email != "")&&(comprobar_email(email))){
	$('error_email').show();
	return false;
    }
    Modalbox.hide();
    return true;  
}

function comprobar_form_direct(url){
    
    $$('.error').invoke('hide');

    if (comprobar_url_gen(url)){
	$('error_url').show();
	return false;
    }

    Modalbox.hide();
    return true;  
}


function comprobar_form_notice(date, re_date){
    
    $$('.error').invoke('hide');

    if (comprobar_date(date, re_date)){
	$('error_date').show();
	return false;
    }

    Modalbox.hide();
    return true;  
}


function comprobar_form_event(date, re_date, duration){
    
    $$('.error').invoke('hide');

    if (comprobar_date(date, re_date)){
	$('error_date').show();
	return false;
    }

    duration = parseInt(duration);

    if (isNaN(duration)){
	$('error_duration').show();
	return false;
    }

    Modalbox.hide();
    return true;  
}


function comprobar_form_cpu(ip, min, max, num){
    min = parseInt(min);
    max = parseInt(max);
    num = parseInt(num);
    
    $$('.error').invoke('hide');
     
    if (isNaN(max)){
	$('error_max_no_num').show();
	return false;
    }
    if (isNaN(min)){
	$('error_min_no_num').show();
	return false;
    }
    if (isNaN(num)){
	$('error_num_no_num').show();
	return false;
    }
    if (max < 0){
	$('error_max_negativo').show();
	return false;
    }
    if (min < 0){
	$('error_min_negativo').show();
	return false;
    } 
    if (num < 0){
	$('error_num_negativo').show();
	return false;
    }  
    if (max < min) {
	$('error_max').show();
	return false;
    }
    if (num > max){
	$('error_num_sup').show();
	return false;
    }
    if (num < min){
	$('error_num_inf').show();
	return false;
    }
    Modalbox.hide();
    return true;  
}


function comprobar_form_profile(channels, framerate, res1, res2){
  channels = parseInt(channels);
  framerate = parseInt(framerate);
  res1 = parseInt(res1);
  res2 = parseInt(res2);

  
  $$('.error').invoke('hide');
  
  if (isNaN(res1)){
    $('error_resolution_no_num').show();
    return false;
  }
  if (isNaN(res2)){
    $('error_resolution_no_num').show();
    return false;
  }
  if (isNaN(framerate)){
    $('error_framerate_no_num').show();
    return false;
  }
	if (isNaN(channels)){
    $('error_channels_no_num').show();
    return false;
  }
  Modalbox.hide();
  return true;  
}


/*******************************************************
*  
*******************************************************/

function comprobar_ip(ip){
    partes=ip.split('.');
    if (partes.length!=4) {
	return false;
    }
    for (i=0;i<4;i++) {
	numero =partes[i];
	if (numero>255 || numero<0 || numero.length==0 || isNaN(numero)){
	    return false;
	}
    }
    return true;
}


function comprobar_email(email){
    re  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/;
    return !re.test(email);
}


function comprobar_date(date, re){
    return !re.test(date); 
}

function comprobar_url(url){
    var re=/^http:\/\/\w+(\.\w+)*/; 
    return !re.test(url); 
}

function comprobar_url_gen(url){
    var re=/^\w+:\/\/\w+(\.\w+)*/; 
    return !re.test(url); 
}

function comprobar_coorgeo(coorgeo){
    partes=coorgeo.split(',');
    if (partes.length!=2) {
	return true;
    }
    for (i=0;i<2;i++) {
	x =partes[i];
	y = parseFloat(x);
	if (isNaN(y) || x!=y ){
	    return true;
	}
    }
    return false;
}

