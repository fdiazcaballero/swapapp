var $country = $('#product_productLocation_country');
var $state = $('#product_productLocation_state');
var category = {id:'#product_productTaxonomy_category'};
var sub_category = { 
    id: '#product_productTaxonomy_subCategory',
    url_action: Routing.generate('get_sub_categories_form')
    };
    
var subsub_category = { 
    id: '#product_productTaxonomy_subSubCategory',
    url_action: Routing.generate('get_subsub_categories_form')
    };
    
var subsubsub_category = { 
    id: '#product_productTaxonomy_subSubSubCategory',
    url_action: Routing.generate('get_subsubsub_categories_form')
    };
    
var furthersub_category = { 
    id: '#product_productTaxonomy_furtherSubCategory',
    url_action: Routing.generate('get_furthersub_categories_form')
    };

if ($country.val()=="")
    $state.attr('disabled', 'disabled');
if ($(category.id).val()==""){
    hide_next_siblings($(category.id));
//    disable_next_siblings($(category.id));
}
else if ($(sub_category.id).val()==""){
    update_form(category.id, sub_category.id, sub_category.url_action);
    hide_next_siblings($(sub_category.id));
//    disable_next_siblings($(sub_category.id));
}
else if ($(subsub_category.id).val()==""){
    update_form(sub_category.id, subsub_category.id, subsub_category.url_action);
    hide_next_siblings($(subsub_category.id));
//    disable_next_siblings($(subsub_category.id));
}
else if ($(subsubsub_category.id).val()==""){
    update_form(subsub_category.id, subsubsub_category.id, subsubsub_category.url_action);
    hide_next_siblings($(subsubsub_category.id));
//    disable_next_siblings($(subsub_category.id));
}
else{
    update_form(subsubsub_category.id, furthersub_category.id, furthersub_category.url_action);
}

$country.change(function() {
    update_form2($country, $state,'#product_productLocation_state');
});


function update_form2($element_parent, $element_child, child_id){
    if($element_parent.val()!=""){
        $element_child.removeProp('disabled');
    }
    else{
        $element_child.prop('disabled', 'disabled');
    }
    // ... retrieve the corresponding form.
    var $form = $element_parent.closest('form');
    // Simulate form data, but only include the selected country value.
    var data = {};
    data[$element_parent.attr('name')] = $element_parent.val();
    // Submit data via AJAX to the form's action path.
    $.ajax({
      url : $form.attr('action'),
      type: $form.attr('method'),
      data : data,
      success: function(html) {
        // Replace current position field ...
        $(child_id).replaceWith(
          // ... with the returned one from the AJAX response.
          $(html).find(child_id)
        );
        // Position field now displays the appropriate positions.
      }
      ,
      error: function(err){
          alert("Error");
      }
  });
}

$(category.id).change(function(){    
    update_form(category.id, sub_category.id, sub_category.url_action);
});

$(sub_category.id).change(function(){    
    update_form(sub_category.id, subsub_category.id, subsub_category.url_action);
});

$(subsub_category.id).change(function(){    
    update_form(subsub_category.id, subsubsub_category.id, subsubsub_category.url_action);
});

$(subsubsub_category.id).change(function(){    
    update_form(subsubsub_category.id, furthersub_category.id, furthersub_category.url_action);
});

function update_form(parent_id, child_id, url_action){ 
//    disable_next_siblings($(parent_id));
    hide_next_siblings($(parent_id));
    if($(parent_id).val()!=""){
        $.ajax({
          url : url_action,
          type: 'POST',
          data : {parent: $(parent_id).val()},
          success: function(response) {
                if(response.is_success){
                    if(response.data && response.data.length>0){
                        $(child_id).empty();
                        var options=create_select_options(response.data);
                        $(child_id).append(options);
//                        $(child_id).removeAttr("disabled");
                        $(child_id).parent('div').parent('div').show();                        
                    }
                    else{
//                        disable_next_siblings($(parent_id));
                        hide_next_siblings($(parent_id));
                    }                    
                }
                else{
//                        disable_next_siblings($(parent_id));
                        hide_next_siblings($(parent_id));
                }
          }
          ,
          error: function(err){
              alert("Error");
          }
      });
    }
}

function disable_option(select_element){
    select_element.empty();
    select_element.append("<option value=''> --  None  -- </option>");
    select_element.attr('disabled', 'disabled');
    
    return false;
}

function disable_next_siblings(select_element){
    select_element.parent('div').parent('div').nextAll().each(function(){
        disable_option($(this).find('select'));
    })
    return false;
}

function hide_form_row(row){
    row.find('select').empty();
    row.find('select').append("<option value=''> --  None  -- </option>");
    row.hide();    
    return false;
}

function hide_next_siblings(select_element){
    select_element.parent('div').parent('div').nextAll().each(function(){
        hide_form_row($(this));
    })
    return false;
}

function create_select_options(array){
    var options ="<option value=''> --  None  -- </option>";
    for(var i=0; i<array.length ; i++){
        options+="<option value='"+array[i].id+"'>"+array[i].name+"</option>";
    }
    return options;
}


