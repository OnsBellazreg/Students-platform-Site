
  function count_up(obj, limit) {
  var cnt = $("#counter > span");
  var txt = $(obj).val(); 
  var len = txt.length;
    
  // check if the current length is over the limit
  if(len > limit){
    $(obj).val(txt.substr(0,limit));
    $(cnt).html(len-1);
  } 
  else { 
    $(cnt).html(len);
  }
     
  // check if user has less than 20 chars left
  if(limit-len <= 20) {
    $(cnt).addClass("warning");
  }
  document.getElementById('counter').innerHTML = obj.value.length;
}

