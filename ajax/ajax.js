function objetoAjax(){
	
	var xmlhttp=false;
	
	try
	{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} 
	
	catch (e) 
	{
		try 
		{
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} 
		catch (E)
		{
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined')
	{
		xmlhttp = new XMLHttpRequest();
	}
	
	return xmlhttp;
}

function calcular(){
  //donde se mostrará lo resultados
  divResultado = document.getElementById('resultado');
  //divResultado.innerHTML= '<img src="iconos/anim.gif">';


  //valores de las cajas de texto
  fecha=document.form1.fecha.value;


for (var i=0; i < document.form1.igv_incluye.length; i++) 
   { 
   if (document.form1.igv_incluye[i].checked) 
      { 
      igv_incluye = document.form1.igv_incluye[i].value; 
      } 
   } 



 // igv_incluye=valor;//document.getElementById('igv_incluye').value;   
  ciudad_origen=document.form1.ciudad_origen.value;
  courier_destino=document.form1.courier_destino.value;  
  zona=document.form1.zona.value; 
  ciudad_destino=document.form1.ciudad_destino.value;  
  empresa_remite=document.form1.empresa_remite.value;  
  centrocosto=document.form1.centrocosto.value;  
  cargoremitente=document.form1.cargoremitente.value;
  consignadoa=document.form1.consignadoa.value;  
  distritoconsignado=document.form1.distritoconsignado.value;  
  direccionconsignado=document.form1.direccionconsignado.value;
  contacto=document.form1.contacto.value;  
  forma_pago=document.form1.forma_pago.value;  
  autorizadopor=document.form1.autorizadopor.value;  
  tipo_envio=document.form1.tipo_envio.value;  
  cantidad=document.form1.cantidad.value; 
  
for (var x=0; x < document.form1.vol_excesivo.length; x++) 
{ 
	if (document.form1.vol_excesivo[x].checked) 
	{ 
	
	document.form1.vol_excesivo[x].checked=true;
	}
} 
  
  
  vol_excesivo=5;  
  
  vol_maximo=document.form1.vol_maximo.value;  
  vol_simple=document.form1.vol_simple.value;  
  cant_vexcesivo=document.form1.cant_vexcesivo.value;  
  cant_vmaximo=document.form1.cant_vmaximo.value;  
  cant_vsimple=document.form1.cant_vsimple.value;  
  costovolumen_excesivo=document.form1.costovolumen_excesivo.value; 
  costovolumen_maximo=document.form1.costovolumen_maximo.value;    
  costovolumen_simple=document.form1.costovolumen_simple.value;  
  costovolumen=document.form1.costovolumen.value;    
  peso=document.form1.peso.value;
  primerkg=document.form1.primerkg.value;    
  kgadicional=document.form1.kgadicional.value;    
  tipo_servicio=document.form1.tipo_servicio.value;    
  costoservicio=document.form1.costoservicio.value;    
  embalaje=document.form1.embalaje.value;   
 // cant_embalaje=document.form1.cant_embalaje.value;   
  fragilidad=document.form1.fragilidad.value;   
 // cant_fragilidad_excesivo=document.form1.cant_fragilidad.value;   
  recibidopor=document.form1.recibidopor.value;   
  observaciones=document.form1.observaciones.value;
  subtotal=document.form1.subtotal.value;  
  igv=document.form1.igv.value;      
  total=document.form1.total.value;   
  recepcionadopor=document.form1.recepcionadopor.value;  
  dni=document.form1.dni.value;
  fecha2=document.form1.fecha2.value;    
  hora=document.form1.hora.value;   
 

  //instanciamos el objetoAjax
  ajax=objetoAjax();
  //uso del medoto POST
  //archivo que realizará la operacion
  //registro.php
  ajax.open("POST", "form_cargo.php",true);
  ajax.onreadystatechange=function() {
  if (ajax.readyState==4) {
  //mostrar resultados en esta capa
  divResultado.innerHTML = ajax.responseText

  
  }
  }


  ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  //enviando los valores
  
  ajax.send("fecha="+fecha+"&igv_incluye="+igv_incluye+"&ciudad_origen="+ciudad_origen+"&courier_destino="+courier_destino+"&zona="+zona+"&ciudad_destino="+ciudad_destino+"&empresa_remite="+empresa_remite+"&centrocosto="+centrocosto+"&cargoremitente="+cargoremitente+"&consignadoa="+consignadoa+"&distritoconsignado="+distritoconsignado+"&direccionconsignado="+direccionconsignado+"&contacto="+contacto+"&forma_pago="+forma_pago+"&autorizadopor="+autorizadopor+"&tipo_envio="+tipo_envio+"&cantidad="+cantidad+"&vol_excesivo="+vol_excesivo+"&vol_maximo="+vol_maximo+"&vol_simple="+vol_simple+"&costovolumen_excesivo="+costovolumen_excesivo+"&costovolumen_maximo="+costovolumen_maximo+"&costovolumen_simple="+costovolumen_simple+"&costovolumen="+costovolumen+"&peso="+peso+"&primerkg="+primerkg+"&kgadicional="+kgadicional+"&tipo_servicio="+tipo_servicio+"&costoservicio="+costoservicio+"&embalaje="+embalaje+"&fragilidad="+fragilidad+"&cant_fragilidad_excesivo="+recibidopor+"&observaciones="+observaciones+"&subtotal="+subtotal+"&total="+total+"&recepcionadopor="+recepcionadopor+"&fecha2="+fecha2+"&hora="+hora)
}

