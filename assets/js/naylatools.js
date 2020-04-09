function ProsesForm(halaman) {
  var valid = document.getElementById("iniForm").checkValidity();
  if (valid) {
    var data = $("#iniForm").serialize();
    event.preventDefault();
    $("#simpan").prop("disabled", true);
    $("#simpan").addClass("btn--loading");

    $.ajax({
      url: "sys/crud.php",
      type: "POST",
      data: data,
      dataType: "JSON",
      async: true,
      cache: false,
      success: function(response) {
        if (response.status == "Success") {
          $("#tampil").load("view/" + halaman);
          $("#tutupModal").click();
          pesan(response.pesan, 3000);
        } else {
          alert(response.pesan);
          $("#simpan").prop("disabled", false);
          $("#simpan").removeClass("btn--loading");
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert("ERROR : " + xhr.responseText);
        $("#simpan").prop("disabled", false);
        $("#simpan").removeClass("btn--loading");
      }
    });
  }
}

function CurtomForm(data, halaman) {
  var valid = document.getElementById("iniForm").checkValidity();
  if (valid) {
    event.preventDefault();
    $("#simpan").prop("disabled", true);
    $("#simpan").addClass("btn--loading");

    $.ajax({
      url: "sys/crud.php",
      type: "post",
      data: data,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(response) {
        if (response.status != "Success") {
          $("#tampil").load("view/" + halaman);
          $("#tutupModal").click();
          pesan(response.pesan, 3000);
        } else {
          alert(response.pesan);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert("ERROR : " + xhr.responseText);
        $("#simpan").prop("disabled", false);
        $("#simpan").removeClass("btn--loading");
      }
    });
  }
}

//modal load
function modal(url, ukuran) {
  $('#modal').show();
  $("#tampilModal").html("");
  $("#jenisModal").removeClass("modal-xl");
  $("#jenisModal").removeClass("modal-sm");
  $("#jenisModal").removeClass("modal-lg");
  $("#jenisModal").addClass(ukuran);
  $("#tampilModal").load(url);
}

//pilih menu
function pilihMenu(menu, caption, idMenu) {
  document.getElementById("anak").innerHTML = caption;
  document.getElementById("loading").style.display = "block";
  var h;
  var e = document.getElementsByClassName("activeNav");
  for (h = 0; h < e.length; h++) {
    e[h].style.color = "grey";
    e[h].classList.remove("activeNav");
  }
  document.getElementById(idMenu).classList.add("activeNav");
  document.getElementById(idMenu).style.color = "#fff";
  window.history.pushState("data", "Title", encodeURI("?halaman=" + caption));
  document.title = caption;
  $("#tampil").load("view/" + menu);
}

//Menu
(function($, window) {
  $.fn.contextMenu = function(settings) {
    return this.each(function() {
      $(this).on("contextmenu", function(e) {
        if (e.ctrlKey) return;
        var $menu = $(settings.menuSelector)
          .data("invokedOn", $(e.target))
          .show()
          .css({
            position: "absolute",
            left: getMenuPosition(e.clientX, "width", "scrollLeft"),
            top: getMenuPosition(e.clientY, "height", "scrollTop")
          })
          .off("click")
          .on("click", "a", function(e) {
            $menu.hide();

            var $invokedOn = $menu.data("invokedOn");
            var $selectedMenu = $(e.target);

            settings.menuSelected.call(this, $invokedOn, $selectedMenu);
          });
        return false;
      });
      $("body, table, tr").click(function() {
        $(settings.menuSelector).hide();
      });
      $("body, table").contextmenu(function() {
        $(settings.menuSelector).hide();
        return false;
      });
    });

    function getMenuPosition(mouse, direction, scrollDir) {
      var win = $(window)[direction](),
        scroll = $(window)[scrollDir](),
        menu = $(settings.menuSelector)[direction](),
        position = mouse + scroll;
      if (mouse + menu > win && menu < mouse) position -= menu;
      return position;
    }
  };
})(jQuery, window);

//pagination
function pagination(act, halaman) {
  $("#tampil").load("view/" + act + "?pg=" + halaman);
  document.getElementById("loading").style.display = "block";
}

// notifikasi
// var refreshId = setInterval(function() {
//   $("#notifikasi").load("view/notifikasi.php");
// }, 10000);

//dynamic button
$(function() {
  $(document)
    .on("click", ".btn-add", function(e) {
      e.preventDefault();

      var controlForm = $(".controls:first"),
        currentEntry = $(this).parents(".entry:first"),
        newEntry = $(currentEntry.clone()).appendTo(controlForm);

      newEntry.find("input").val("");
      controlForm
        .find(".entry:not(:last) .btn-add")
        .removeClass("btn-add")
        .addClass("btn-remove")
        .removeClass("btn-success")
        .addClass("btn-danger")
        .html('<span class="fa fa-minus-square"></span>');
    })
    .on("click", ".btn-remove", function(e) {
      $(this)
        .parents(".entry:first")
        .remove();

      e.preventDefault();
      return false;
    });
});