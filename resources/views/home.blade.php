@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="question">

                    </div>
                    <div id="buttons"> <button id="skip" onClick="skipQuestion()">Skip</button> <button id="next" onClick="getMessage()">Next</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
    getMessage();

    function getMessage() {
        $.ajax({
            type:'GET',
            url:'/getQuestions',
            success:function(data) {
                if(data.status === "success"){
                    $('#question').html(createTemplate(data.data));
                }
                
            }
        });
    }

    function createTemplate(data){

        var template = "";
        if(data.question){
            template += "<h3>"+data.question.title+"</h3> <ul>";
            $.each(data.question.options,(index,option) => {
                template += "<li><input type='radio' name='question' onClick='submitAnswer("+option.id+","+option.type+")' value='"+option.id+"'> "+option.title+"</li>";
            })
            template += "</ul>";
            $("#skip").attr('data-question-id',data.question.id);
        }else{
            template += "correct answers is "+data.correctAnswers+" and incorrect answers is "+ data.inCorrectAnswers+" and you skip " +data.skipedQuestions+" questions";
            $("#buttons").hide();
        }
            
        return template;
    }

    function submitAnswer(optionID,type){

        const formData = new FormData();

        formData.append("optionID", optionID);
        formData.append("_token", "<?php echo csrf_token() ?>");
        formData.append("type", type);

        $.ajax({
            type:'POST',
            url:'/submitAnswer',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            success:function(response) {
                if(response.status === "success"){
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success"
                    });
                }else{
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error"
                    });
                }
                
                getMessage();
            }
        });
    }
    function skipQuestion(){

        let questionID = $("#skip").attr('data-question-id');

        const formData = new FormData();

        formData.append("questionID", questionID);
        formData.append("_token", "<?php echo csrf_token() ?>");

        $.ajax({
            type:'POST',
            url:'/skipQuestion',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            success:function(response) {
                if(response.status === "success"){
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success"
                    });
                }else{
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error"
                    });
                }
                getMessage();
            }
        });
    }
</script>
@endsection
