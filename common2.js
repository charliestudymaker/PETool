function SavePEDevUse(v)
      {
	var pData;

	pData = "DevUse=" + v;
	pData = pData + "&StudyID=" + document.peform.StudyID.value;
	ajax("savedevuse.php",pData)
      }

function ajax(url, vars){
 
        if (window.XMLHttpRequest){
                var request = new XMLHttpRequest();
        }else{
                var request = new ActiveXObject("MSXML2.XMLHTTP.3.0");
        }
 
        request.open("POST", url, true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
 
        request.onreadystatechange = function(){
 
                if (request.readyState == 4 && request.status == 200) {
 
                        if (request.responseText)
			{

                        }
                }
        }
        request.send(vars);
}


function validatePEForm(){

	if (document.getElementById('StudyID').value.length==0)	
	    {
		document.getElementById('QSID').style.backgroundColor='red';
		alert('You must provide a QUADRIC Study ID');	
		return false;
	    }

	
	return true;
}

function setRadioColor(elID, rGroup){
	var red, grey, white, cell;
	var ret = true;
	
	red = '#ff0000';
	grey = '#d3d3d3';
	white = 'ffffff';
	//Get the table cell surrounding the radio buttons
	cell = document.getElementById(elID);
	
	if( cell ){
		//Set the table cell color to red if neither radio button is checked
		if( !rGroup[0].checked && !rGroup[1].checked ){
			ret = false;
			cell.style.backgroundColor = red;
		}else{
				//Otherwise set the color back to grey
				//This is necessary in the case where a cell was previously turned red
				cell.style.backgroundColor = white;
		}
	}else{
		alert('ERROR:  Could not get element by id');
	}
	
	return ret;
}

function validateACSForm(){
	var ret = true;
	
	if( !setRadioColor( "chestpain", acsform.chestpain) ){
		ret = false;
	}
	if( !setRadioColor( "sex", acsform.sex) ){
		ret = false;
	}
	if( !setRadioColor( "hist", acsform.hist) ){
		ret = false;
	}
	if( !setRadioColor( "diap", acsform.diap) ){
		ret = false;
	}
	if( !setRadioColor( "ekg", acsform.ekg) ){
		ret = false;
	}
	if( !setRadioColor( "twave", acsform.twave) ){
		ret = false;
	}
	
	if( !ret ){
		alert('One or more required form values were not filled in.');
	}
	
	return ret;
}

function clearRadio( radio ){
	radio[0].checked = false;
	radio[1].checked = false;
}

function setCellColor( elID, color ){
	var cell;

	cell = document.getElementById(elID);	
	cell.style.backgroundColor = color;
}

function resetACSInputs(){
	
	clearRadio(acsform.chestpain);
	clearRadio(acsform.sex);
	clearRadio(acsform.hist);
	clearRadio(acsform.diap);
	clearRadio(acsform.ekg);
	clearRadio(acsform.twave);
	
	setCellColor("chestpain", '#ffffff');
	setCellColor("sex", '#ffffff');
	setCellColor("hist", '#ffffff');
	setCellColor("diap", '#ffffff');
	setCellColor("ekg", '#ffffff');
	setCellColor("twave", '#ffffff');
	return false;
}

function windowThresh(){
	win = window.open('thresh.php','thresh','menubar=0,statusbar=0,scrollbars=1,width=640,height=480');
	win.focus();
}

function tooltip(type, id){
	var tip;
	
	tip = '';
	
	if( type == 'acs' ){
		switch(id){
			case 'chestpain':
				tip = 'Chest Pain increases with gentle pressure from the physician\'s hand';
				break;
			case 'hist':
				tip = 'Any prior coronary artery disease, including prior MI, CABG, stenting, or stable, medically treated disease';
				break;
			case 'diap':
				tip = 'Sweating now or with the symptoms that brought the patient to the ED';	
				break;
			case 'ekg':
				tip = 'EKG Findings have >0.5uV of ST depression in more than one lead, whether contiguous or not';
				break;	
			case 'twave':
				tip = 'T-wave inversion in any one or more leads other than V1 Or aVR';
				break;
		}
	}else if( type == 'pe' ){
		switch( id ){

			case 'dyspnea':
				tip = 'Patient perception of difficulty breathing at the time of evaluation. Includes sensation described as <b>shortness of breath</b>,breathlessness, labored breathing, trouble breathing, <i>not breathing right</i>';
				break;
			case 'chestpain':
				tip = 'Focal pain in the thorax located inferior to the transverse axis through the clavicles extending to the costal margin. The pain must change with breathing and must not be reproduced by palpation.';
				break;
			case 'sao2':
	   		tip = 'Pulse oximetry reading lowest value below 95% with the patient breathing room air for more than 2 minutes.';
	   		break;
	   	case 'hr':
	   		tip = 'Pulse rate (highest value) measured from a monitor or pulse oximetry machine that is above 99 beats per minute.';
	   		break;
			case 'hrt':
	   		tip = 'Any orally ingested estrogen product or progestin-containing contraceptive. Transdermal systems included as \'yes\' although no data to support';
	   		break;
	   	case 'hist':
	   		tip = 'Patient report of venous thrombosis at any site (leg, arm, neck, portal vein, pelvis or lung) requiring anticoagulation treatment.';
	   		break;
			case 'swell':
				tip = 'Observed swelling of one leg measured by holding the patient\'s heels and visually comparing the calf girths and asking \'are they symmetrical or not\' If not, then the answer is \'yes\'.';
				break;
			case 'hemop':
	   		tip = 'Patient report of coughing up blood within last 5 days. Includes blood streaking, rusty sputum or frank blood.';
	   		break;
			case 'surgery':
	   		tip = 'Trauma requiring hospitalization or surgery. Definition of surgery requires general endotracheal or epidural anesthesia >30 min. Either trauma or surgery had to occur within prior 30 days.';
	   		break;
	   	}
	}
	
	if( tip != '' ){
		return overlib(tip);
	}
}