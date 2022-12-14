$(document).ready(function () {
  $("#treeview_div").jstree({
    core: {
      check_callback: function (
        operation,
        node,
        node_parent,
        node_position,
        more
      ) {
        if (operation === "move_node") {
          url = window.location.href + "&act=moveAjax";
          $.ajax({
            type: "post",
            url: url,
            method: "POST",
            data: {
              id: node.id,
              name: node.name,
              children: node.children_d,
              parent: node_parent.id,
              action: "move",
            },
          }).done(function (response) {
            console.log("move: " + response);
            response = JSON.parse(response);
            if (response.status == "success") {
              location.reload();
            }
          });
        }
        // return operation === 'move_node' ? true : false;
        return true;
      },
      force_text: true,
    },
    plugins: ["contextmenu", "dnd", "search", "state", "wholerow"],
  });

  $(".create").click(function () {
    var ref = $("#treeview_div").jstree(true);
    sel = ref.get_selected();
    if (!sel.length) {
      sel = null;
    } else {
      sel = sel[0];
    }
    sel = ref.create_node(sel, { type: "file" });
    if (sel) {
      ref.edit(sel);
    }
  });
  $("#treeview_div")
    .on("create_node.jstree", function (e, data) {
      last_id = data.node.id;
      url = window.location.href + "&act=addAjax";
      $.ajax({
        type: "post",
        url: url,
        method: "POST",
        data: {
          parent: data.parent,
          name: "New node",
          action: "create",
        },
      }).done(function (response) {
        console.log(response);
        response = JSON.parse(response);
        if (response.status == "success") {
        }

        // url= window.location.href + "&act=getAjax";
        // $.get(url, function(response,status){
        //   console.log("Data: " + response);
        //   alert("status: " + status);
        // });
      });
    })
    .jstree();
  $("#treeview_div")
    .on("rename_node.jstree", function (e, data) {
      console.log("rename_node: " + data);
      url = window.location.href + "&act=editAjax&id=" + data.node.id;
      console.log(typeof Number(data.node.id));
      id = Number(data.node.id).toString() == "NaN" ? "NaN" : data.node.id;
      console.log("id: " + id);
      $.ajax({
        type: "post",
        url: url,
        method: "POST",
        data: {
          id: id,
          name: data.text,
          action: "rename",
        },
      }).done(function (response) {
        console.log("rename_node1: " + response);
        if (response.status == "success") {
          location.reload();
        }
      });
    })
    .jstree();

  $(".rename").click(function () {
    var ref = $("#treeview_div").jstree(true),
      sel = ref.get_selected();
    if (!sel.length) {
      return false;
    }
    sel = sel[0];
    ref.edit(sel);
  });
  $(".delete").click(function () {
    var ref = $("#treeview_div").jstree(true),
      sel = ref.get_selected();
    if (!sel.length) {
      return false;
    }
    ref.delete_node(sel);
  });
  $("#treeview_div")
    .on("delete_node.jstree", function (e, data) {
      console.log("delete: ", data);
      url = window.location.href + "&act=deleteAjax";
      $.ajax({
        type: "post",
        url: url,
        method: "POST",
        data: {
          path: data.node.id,
          child: data.node.children_d,
        },
      }).done(function (data) {
        if (data.status == "success") {
          console.log("delete :" + data);
        }
      });
    })
    .jstree();
  // function active() {
  //   $(".Cancel").on("click", function () {
  //     $(".form-active").fadeOut(1);
  //     $("body").css({ "background-color": "white" });
  //   });
  //   $(".Add").on("click", function () {
  //     var name = $("#name").val();
  //     var description = $("#description").val();
  //     var cost = $("#cost").val();
  //     var category = $("#category").val();
  //     var photo = $("#photo").val();
  //     var url =
  //       "http://localhost/php-oop-mvc-2021/index.php?ctl=products&act=add";
  //     var formData = new FormData($("#form-data")[0]);
  //     formData.append("category", category);
  //     $.ajax({
  //       type: "POST",
  //       url: url,
  //       processData: false,
  //       contentType: false,
  //       data: formData,
  //     }).done(function (response) {
  //       location.reload();
  //     });
  //   });
  // }
  // $("#New").click(function (event) {
  //   $("body").css({ "background-color": "rgb(0,0,0,0.5)" });
  //   $(".Add").html("Add");
  //   event.stopPropagation();
  //   $(".form-active")
  //     .css({ "background-color": "white", "z-index": "1", top: "0" })
  //     .slideDown("fast", active());
  // });
  // var value = "";
  // let len = $(".product").length;
  // $("#select").change(function () {
  //   let url = window.location.href + "&act=getCategories";
  //   value = $(this).val();
  //   $.ajax({
  //     type: "post",
  //     url: url,
  //     data: { value },
  //   }).done(function (response) {
  //     for (let i = 0; i < len; i++) {
  //       console.log(response.includes($(".product").eq(i).attr("category")));
  //       if (!response.includes($(".product").eq(i).attr("category"))) {
  //         $(".product").eq(i).addClass('non-active');
  //       }else {
  //         $(".product").eq(i).removeClass('non-active');
  //       }
  //     }
  //   });
  // });
});
