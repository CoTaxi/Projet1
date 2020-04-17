$(document).on('change','.garage2, .rdv2',function(){
  let $field = $(this)
  let $garageField =$('.garage2')
  let $rdvField =$('.rdv2')
  let $form = $field.closest('form')
  let data = {}
  data[$garageField.attr('name')] = $garageField.val()
  data[$rdvField.attr('name')] = $rdvField.val()
  data[$field.attr('name')] = $field.val()
  $.post($form.attr('action'), data).then(function (data) {
    let $input = $(data).find('.rdv2')
    $('.rdv2').replaceWith($input)
  })
})

// $(document).ready(function () {
//   $('.rdv2').hide();
//   $('.garage2').click(function () {
//     $('.rdv2').show();
//   });
//   $('#taxicobundle_rdv_rdv').show();
// });
