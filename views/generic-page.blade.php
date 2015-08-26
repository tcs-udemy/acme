@extends('base')

@section('browsertitle')
    {{ $browser_title }}
@stop

@section('content')
    @if ((Acme\Auth\LoggedIn::user()) && (Acme\Auth\LoggedIn::user()->access_level == 2))
    <form method="post" action="/admin/page/edit" id="editpage" name="editpage">
        <article id="editablecontent" class='editablecontent' itemprop="description" style='width: 100%; line-height: 2em;'>
            {!! $page_content !!}
        </article>
        <article class="admin-hidden">
            <a class="btn btn-primary" href="#!" onclick="saveEditedPage()">Save</a>
            <a class="btn btn-info" href="#!" onclick="turnOffEditing()">Cancel</a>
            &nbsp;&nbsp;&nbsp;
        </article>
        <input type="hidden" name="thedata" id="thedata">
        <input type="hidden" name="old" id="old">
        <input type="hidden" name="page_id" value="{!! $page_id !!}">
    </form>
    @else
        {!! $page_content !!}
    @endif
@stop

@section('bottomjs')
<script>
    @if ((Acme\Auth\LoggedIn::user()) && (Acme\Auth\LoggedIn::user()->access_level == 2))

    var editor;

    function makePageEditable(item){
        if ($(".editablecontent").length != 0) {
            $(".admin-hidden").addClass('admin-display').removeClass('admin-hidden');
            $(item).attr("onclick","turnOffEditing(this)");
            $(item).html("Turn off editing");
            $(".editablecontent").attr("contenteditable","true");
            $(".editablecontent").addClass("outlined");
            $("#old").val($("#editablecontent").html());

            var editoroptions = {
                allowedContent: true,
                floatSpaceDockedOffsetX: 150
            }

            var elements = document.getElementsByClassName( 'editablecontent' );
            for ( var i = 0; i < elements.length; ++i ) {
                CKEDITOR.inline( elements[ i ], editoroptions );
            }

            CKEDITOR.on( 'instanceLoaded', function(event) {
                    editor = event.editor;
            });
        } else {
            alert ('No editable content on page!');
        }
    }


    function turnOffEditing(item) {
        for (name in CKEDITOR.instances) {
            CKEDITOR.instances[name].destroy()
        }
        $(".admin-display").addClass('admin-hidden').removeClass('admin-display');
        $(".menu-item").attr("onclick","makePageEditable(this)");
        $(".menu-item").html("Edit content");
        $(".editablecontent").attr("contenteditable","false");
        $(".editablecontent").removeClass("outlined");
        if ($('#old').val() != ''){
            $(".editablecontent").html($("#old").val());
        }
    }

    function saveEditedPage() {
        // get the data from ckeditor
        var pagedata = editor.getData();
        // save this data
        $("#thedata").val(pagedata);
        var options = { success: showResponse };
        $("#editpage").unbind('submit').ajaxSubmit(options);
        $("#old").val('');
        turnOffEditing();
        return false;
    }

    function showResponse()
    {
        alert("Called save");
    }
    @endif
</script>
@stop
