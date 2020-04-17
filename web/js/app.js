$(document).on('change','#taxicobundle_rdv_service, #taxicobundle_rdv_garage',function(){
  let $field = $(this)
  let $serviceField =$('#taxicobundle_rdv_service')
  let $garageField =$('#taxicobundle_rdv_garage')
  let $form = $field.closest('form')
  let data = {}
  data[$serviceField.attr('name')] = $serviceField.val()
  data[$garageField.attr('name')] = $garageField.val()
  data[$field.attr('name')] = $field.val()
  $.post($form.attr('action'), data).then(function (data) {
    let $input = $(data).find('#taxicobundle_rdv_garage')
    $('#taxicobundle_rdv_garage').replaceWith($input)
  })
})
