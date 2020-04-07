@extends('../layouts.welcome')
@section('title')
<title>Create a thread</title>
@endsection
@section('content')
<div class="card">
    <div class="card-header bg-myblue">
        <div class="card-title">Creating a thread</div>
    </div>
    <div class="card-body">
        <form>
            <div class="form-row">
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="title"> Title </label>
                    <input type="text" name="title" id="title" class="form-control input" placeholder="Write the title for your thread" />
                    <div class="row">
                        <span style="font-size:10pt; color:red" class="ml-3" id="title-warning"></span> 
                        <span style="font-size:7pt; margin-top:0px;" class="ml-auto mr-3" id="title-length">255</span> 
                    </div> 
                    
                    
                </div>
                <div class="form-group col-lg-6 col-sm-12">
                    <label for="topic"> Topic </label>
                    <select name="topic" id="topic" class="form-control">
                        <option value="Sports">Sports</option>
                        <option value="Politics">Politics</option>
                        <option value="Economy">Economy</option>
                        <option value="Games">Games</Gption>
                        <option value="Health">Health</option>
                        <option value="Programming">Programming</option>
                        <option value="Others">Others</option>
                    </select>

                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-12">
                    <label for="subtitle"> Subtitle </label>
                    <input type="text" name="subtitle" id="subtitle"  class="form-control input" placeholder="Write the subtitle for your thread" />
                    <div class="row">
                        <span style="font-size:10pt; color:red" class="ml-3" id="subtitle-warning"></span>
                        <span style="font-size:7pt; margin-top:0px;" class="ml-auto mr-3" id="subtitle-length">255</span> 
                    </div>
                    
                     
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="description">Description</label>
                    <textarea name="description" rows='5' id="description" class="form-control input" placeholder="Write the description of the thread"></textarea>
                    <div class="row">
                        <span style="font-size:10pt; color:red" class="ml-3" id="description-warning"></span> 
                        <span style="font-size:7pt; margin-top:0px;" class="ml-auto mr-3" id="description-length">1000</span> 
                    </div> 
                    
                </div>
            </div>
            <div id="code-row" class="form-row hidden">
                <div class="form-group col-12">
                    <label for="code">Code</label>
                    <textarea name="code" rows='10' id="code" class="form-control textarea-wrapper" placeholder="Place your code here, if necessary"></textarea>                     
                </div>
            </div>
            <div class="row justify-content-end">
                <button class="btn btn-primary mr-3" id="btn-submit">Criar</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<!-- <script src="jquery.numberedtextarea.js"></script> -->
<script>

$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});

$(".input").keyup(function(e) {
    const {name, value} = e.target
    if(name!="description") {
        $("#"+name+"-length").html(255-value.length)
        if(255-value.length < 10) {
            $("#"+name+"-length").css('color','red')
        }
        else if (255-value.length < 30) {
            console.log('entrei')
            $("#"+name+"-length").css('color','yellow')
        }
        else {
            $("#"+name+"-length").css('color','black')
        }
    }
    else {
        $("#description-length").html(1000-value.length)
    }
    
});

$("#btn-submit").click(function(e){

  

    e.preventDefault();



    var title = $("input[name=title]").val();

    var subtitle = $("input[name=subtitle]").val();

    var topic = $("select[name=topic]").val();

    var description = $("textarea[name=description]").val();

    var code = $("textarea[name=code]").val();
    var ok = 1;

    if (!(/\S/.test(description))) {
        $("#description").addClass("border border-danger")
        $("#description-warning").html("Please type a valid description");
        ok=0
    } else if (description.length > 1000) {
        $("#description").addClass("border border-danger")
        $("#description-warning").html("Write a shorter description");
        ok=0
    }
    if (!(/\S/.test(title))) {
        $("#title").addClass("border border-danger")
        $("#title-warning").html("Please type a valid title");
        ok=0
    }else if (title.length > 255) {
        $("#title").addClass("border border-danger")
        $("#title-warning").html("Write a shorter title");
        ok=0
    }
    if (!(/\S/.test(subtitle))) {
        $("#subtitle").addClass("border border-danger")
        $("#subtitle-warning").html("Please type a valid subtitle");
        ok=0
    }else if (subtitle.length > 255) {
        $("#subtitle").addClass("border border-danger")
        $("#subtitle-warning").html("Write a shorter subtitle");
        ok=0
    }
    
    if (ok==1) {
        $("#title").removeClass("border border-danger")
        $("#title-warning").html("");
        $("#description").removeClass("border border-danger")
        $("#description-warning").html("");
        $("#subtitle").removeClass("border border-danger")
        $("#subtitle-warning").html("");
        $
        $.ajax({

            type:'POST',

            url:'/thread',

            data:{title:title, subtitle:subtitle, topic:topic, description:description, code:code},

            success:function(data){

                alert("Thread criada com sucesso");
                window.location.href = "/";

            }

        });
    }
});

$("#topic").change(function (e) {
    const { value } = e.target
    console.log(value)
    if (value == 'Programming') {
        $("#code-row").removeClass('hidden')
        console.log('sim')
    }
    else {
        console.log('nao')
        $("#code-row").addClass('hidden')
        $("#code").val('')
    }
})

$(document).delegate('#code', 'keydown', function(e) {
  var keyCode = e.keyCode || e.which;
  console.log('fosj')
  if (keyCode == 9) {
    e.preventDefault();
    var start = this.selectionStart;
    var end = this.selectionEnd;

    // set textarea value to: text before caret + tab + text after caret
    $(this).val($(this).val().substring(0, start)
                + "\t"
                + $(this).val().substring(end));

    // put caret at right position again
    this.selectionStart =
    this.selectionEnd = start + 1;
  }
});
</script>
@endsection