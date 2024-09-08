let id_event = $(".id_event").val();

$(".openDropdown").on("click", function () {
  $(this).siblings(".dropdown").slideToggle();
});

$(document).on("click", ".checkall", function () {
  let target = $(this).data("target");
  $(target).prop("checked", $(this).prop("checked"));
});

var typeSearch = 1;
$(".searchname").on("change", function () {
  typeSearch = $(".searchname").find(":selected").val();
  mainPage();
});

$(document).on("click", ".checkboxlist", function (e) {
  //btndeletelist
  if ($(".checkboxlist:checkbox:checked").length > 0) {
    $(".btndeletelist").fadeIn();
  } else {
    $(".btndeletelist").fadeOut();
  }
});

// Datatables
// function main(gender = "", type = "") {
//   var dataTable = $(".myTable").DataTable({
//     bAutoWidth: false,
//     // "bInfo" : false,
//     columnDefs: [{ orderable: false, targets: 0 }],
//     order: [[1, "asc"]],
//     bDestroy: true,
//     responsive: true,
//     pageLength: 100,

//     initComplete: function (settings, json) {
//       $(".getNumber").html("");
//       $(".dataTables_info").appendTo(".getNumber");
//     },

//     language: {
//       info: "_TOTAL_",

//       sProcessing: "جارٍ التحميل...",
//       sLengthMenu: " _MENU_ ",
//       sZeroRecords: "لم يعثر على أية سجلات",
//       sInfo: "_TOTAL_ ",
//       sInfoEmpty: "0",
//       sInfoFiltered: "",
//       sInfoPostFix: "",
//       sSearch: "",
//       searchPlaceholder: "ابحث من هنا",
//       sUrl: "",
//       oPaginate: {
//         sFirst: "الأول",
//         sPrevious: "السابق",
//         sNext: "التالي",
//         sLast: "الأخير",
//       },
//     },
//     processing: true,
//     serverSide: true,

//     ajax: {
//       url: "datatables/home.php",
//       type: "POST",
//       data: {
//         gender: gender,
//         type: type,
//         typeSearch: typeSearch,
//         id_event: id_event,
//       },
//       error: function (xhr, error, code) {
//         console.log(xhr, code);
//       },
//     },
//     drawCallback: function (settings) {
//       var response = settings.json;
//       console.log(response);
//       $(".getNumberAttend").html(response.attend);
//     },
//   });
// }
// main();
$("#typePilgrims").on("change", function () {
  let typePilgrims = $(this).val();
  let genderPilgrims = $("#genderPilgrims").val();
  main(genderPilgrims, typePilgrims);
});

$("#genderPilgrims").on("change", function () {
  let typePilgrims = $("#typePilgrims").val();
  let genderPilgrims = $(this).val();
  main(genderPilgrims, typePilgrims);
});

// Ajax

$("#createroom").on("submit", function (event) {
  event.preventDefault();
  $.ajax({
    url: "ajax.php",
    method: "POST",
    data: new FormData(this),
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,

    success: function (data) {
      if (data.status) {
        Swal.fire("تم انشاء الغرفة بنجاح");
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "رقم الغرفة موجود من قبل",
        });
      }
      $("#createroom")[0].reset();
    },
    error: function (err) {
      console.log(err);
    },
  });
});

$(".openRoom").on("click", function (e) {
  let id = $(this).data("roomnumber");
  openRoom(id);
});

function openRoom(id) {
  let idGET = id;
  $.ajax({
    url: "ajax.php",
    method: "POST",
    data: {
      action: "openRoom",
      roomnumber: idGET,
      id_event: id_event,
    },
    success: function (data) {
      if (data == "empty") {
        $(".fetchResponse").html(`
            <div class="alert alert-warning">لا يوجد حجاج</div>
        `);
      } else {
        $(".fetchResponse").html(data);
      }
    },
  });
}
// Insert People To Room
$(".insertBtnMain").on("click", function () {
  var room = $("#valueList").find(":selected").val();
  if (room == "") {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "من فضلك حدد الغرفة اولاً",
    });
  } else {
    var idUsers = new Array();
    if ($(".getVote:checkbox:checked").length > 0) {
      $(".getVote:checkbox:checked").each(function (i) {
        idUsers.push($(this).data("id"));
        $.ajax({
          url: "ajax.php",
          method: "POST",
          data: {
            action: "insertVoteMulti",
            idUsers: idUsers,
            room: room,
          },
          beforeSend: function () {
            $(".loading").css("display", "flex");
          },
          success: function (data) {
            if (data == "fullroom") {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "الغرفة ممتلئة",
              });
            } else {
              var table = $(".myTable").DataTable();
              table.ajax.reload();
            }

            $(".loading").css("display", "none");
          },
        });
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "من فضلك حدد الاشخاص اولاً",
      });
    }
  }
});

//التفاصيل
$(document).on("click", ".details", function () {
  let id = $(this).data("id");
  getDetails(id);
});

function getDetails(id) {
  let getID = id;
  $.ajax({
    url: "ajax.php",
    method: "POST",
    data: {
      action: "details",
      id: getID,
    },
    success: function (data) {
      data = $.trim(data);
      $(".load_deta_details").html(data);
    },
  });
}

// عرض الاشخاص داخل الغرفة
$(document).on("click", ".search_degree", function () {
  let id = $(this).data("id");
  $.ajax({
    url: "ajax.php",
    method: "POST",
    data: {
      action: "search_persons",
      id: id,
    },
    success: function (data) {
      data = $.trim(data);
      $(".load_data_persons").html(data);
    },
  });
});

// تعديل بيانات الشخص
let phone = "";
$(document).on("keyup", ".newValuePhone", function () {
  phone = $(this).val();
});

var comment = "";
$(document).on("keyup", "#comment", function () {
  comment = $(this).val();
});

var superior = "";
$(document).on("change", ".superior", function () {
  superior = $(this).val();
});

var change_name = "";
$(document).on("keyup", ".change_name", function () {
  change_name = $(this).val();
});

var change_gender = "";
$(document).on("change", ".change_gender", function () {
  change_gender = $(this).val();
});

var change_type = "";
$(document).on("change", ".change_type", function () {
  change_type = $(this).val();
});

var room = "";
$(document).on("change", ".room", function () {
  room = $(this).val();
});

$(document).on("click", ".changeDataDetails", function () {
  if (superior == "") {
    superior = $(this).data("superior");
  }
  if (phone == "") {
    phone = $(this).data("phone");
  }
  if (comment == "") {
    comment = $(this).data("comment");
  }

  if (change_name == "") {
    change_name = $(this).data("name");
  }

  if (change_gender == "") {
    change_gender = $(this).data("gender");
  }
  if (change_type == "") {
    change_type = $(this).data("type");
  }

  if (room == "") {
    room = $(this).data("room");
  }

  let id = $(this).data("id");
  $.ajax({
    url: "ajax.php",
    method: "POST",
    data: {
      action: "change_data_person",
      id: id,
      phone: phone,
      comment: comment,
      superior: superior,
      name: change_name,
      gender: change_gender,
      type: change_type,
      room: room,
    },
    success: function (data) {
      getDetails(id);
      Swal.fire({
        icon: "success",
        title: "SUCCESS",
        text: "تم التعديل بنجاح",
      });
    },
  });
});

// Remove List
$(document).on("click", ".btndeletelist", function (e) {
  e.stopPropagation();
  $(".checkboxlist:checked").each(function () {
    let idList = $(this).data("id");
    $.ajax({
      url: "ajax.php",
      method: "POST",
      data: {
        action: "deleteRooms",
        idList: idList,
        id_event: id_event,
      },
      success: function (data) {
        location.reload();
      },
    });
  });
});

$(document).on("click", ".deletePersonFromRoom", function (e) {
  let id = $(this).data("id");
  let roomnumber = $(this).data("roomnumber");
  $.ajax({
    url: "ajax.php",
    method: "POST",
    data: {
      action: "deletePersonFromRoom",
      id: id,
      id_event: id_event,
    },
    success: function (data) {
      openRoom(roomnumber);
    },
  });
});

// Tasks

var id = $(".next_id_task").data("id");
var id_show_task = $("#id_show_task").val();

// show next id task
$(".next_id_task").on("click", function () {
  let hrefAdd = $("#title_task").find("a").attr("href");
  let type = $(this).data("type");
  $.ajax({
    url: "ajax.php",
    type: "post",
    dataType: "json",
    data: { action: "show_next_task", id: id, type: type, id_event: id_event },
    success: function (response) {
      if (type == "next") {
        if (response.next) {
          id_show_task++;
        } else {
          id_show_task = 1;
        }
      } else {
        if (response.prev) {
          id_show_task--;
        } else {
          id_show_task = response.count;
        }
      }

      $("#form_tasks")[0].reset();
      $("#id_show_task").val(id_show_task);
      $("#title_task").html(
        `${response.tasks.title} <a class="btn btn-success" href='${hrefAdd}'>+<a/>`
      );
      $("#id_dask").val(response.tasks.id);
      $("#title_task_page").val(response.tasks.title);
      $("#date_task").val(response.tasks.date);
      $("#desc_task").val(response.tasks.descrption);
      $("#importance_task").val(response.tasks.importance);

      if (response.tasks.status == 1) {
        $("#status_task").attr("checked", true);
      } else {
        $("#status_task").attr("checked", false);
      }
      id = response.tasks.id;
    },
    error: function (xhr, status, error) {
      console.error(error);
    },
  });
});

// Expire Date

var countDownDate = new Date($(".expire_date").val()).getTime();
var x = setInterval(function () {
  $("#timer").css("display", "flex");
  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  $("#timer .day").html(days + "يوم");
  $("#timer .hour").html(hours + "ساعة");
  $("#timer .minute").html(minutes + "دقيقة");
  $("#timer .second").html(seconds + "ثانية");

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    $("#block").css("display", "flex");
    $(".d-textitme").hide();
    $("#timer .day").html("صفر");
    $("#timer .hour").html("صفر");
    $("#timer .minute").html("صفر");
    $("#timer .second").html("صفر");
  }
}, 1000);
