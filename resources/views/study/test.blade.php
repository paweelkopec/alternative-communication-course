@extends('layouts.app')

@section('content')
<div class="container mainContainer">
	<div class="row">
		<div style="margin-top: -14px; margin-bottom:-14px; padding-top:10px;">
			<h1 class="special-title">Kurs {{ $course->name }}</h1>
			<div class="hidden" id="result">
			   <p>Wynik:</p>
			   <p id="total-question">Liczba wszystkich pytań: <span></span></p>
			   <p id="correct" style="color: green;">Poprawne odpowiedzi: <span></span></p>
			   <p id="incorrect" style="color: red;">Niepoprawne odpowiedzi: <span></span></p>
			</div>
			<div id="curse">
			<p id="question">
				<b>Pytanie: <span></span> </b>
			</p>
			<div class="text-center" style="margin-bottom: 20px;">
				<img id="image" src="{{ url('/file/') }}/18">
			</div>
			<form>
				<div class="alert alert-success hidden" role="alert">Bardzo
					dobrze!</div>
				<div class="alert alert-warning hidden" role="alert">
					Niestety źle. Prawidłowa odpowiedź: <b></b>
				</div>
				<div class="form-group">
					<label for="answer">Twoja odpowiedź</label> <input type="text"
						class="form-control" id="answer" placeholder="" value="">
				</div>

				<div class="text-right">
					<button type="submit" class="btn btn-lg btn-success"
						id="button-next">Dalej</button>
					<button type="submit" class="btn btn-lg btn-info" id="button-check">Sprawdź</button>
				</div>

			</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var files = {!!$files!!}; 
        var testView = {
            incorrect: 0,
            correct: 0,
            currentKey: 0,
            files: files,
            setFirst: function (){
                var total = Object.keys(this.files).length;
    		var current = this.currentKey+1;
    		$("#question span").text(current+'/'+total);
    		$("#image").prop("src", "{{ url('/file/') }}/" + this.getCurrent().id);
    		$("#button-next").attr("disabled", true);
                $("#button-check").attr("disabled", false);
                
            },
            isNext: function (){
                return this.currentKey < Object.keys(this.files).length-1;
            },
            getCurrent: function (){
                return files[this.currentKey];
            },
            next: function(){
                this.currentKey ++;
                 console.log("next"+ this.currentKey);
            },
            nextClicked: function(e){
        	e.preventDefault();
        	$("#answer").val('').focus();
        	$("#button-check").attr("disabled", false);
                $("#button-next").attr("disabled", true);
        	$(".alert-success, .alert-warning").addClass("hidden");
        	if(this.isNext()){
        	    this.next();
                    var t = Object.keys(this.files).length;;
        	    var c = this.currentKey+1;
                    $("#question span").text(c+'/'+t);
        	    $("#image").prop("src", "{{ url('/file/') }}/" + this.getCurrent().id);
                    $("#button-next").attr("disabled", true);
        	}else{// show results
        	    $("#curse").addClass("hidden");
                    $("#total-question span").text(Object.keys(this.files).length);
        	    $("#correct span").text(this.correct);
        	    $("#incorrect span").text(this.incorrect);
        	    $("#result").removeClass("hidden");
        	}
            },
            checkClicked: function(e){
        	e.preventDefault();
        	$("#button-check").attr("disabled", true);
        	$("#button-next").attr("disabled", false);
        	if(this.getCurrent().name==$("#answer").val()){
        	     $(".alert-success").removeClass("hidden");
        	     this.correct++;
        	}else{
        	     $(".alert-warning b").text( this.getCurrent().name);
        	     $(".alert-warning").removeClass("hidden");
        	     this.incorrect++;
        	}
            }
        
        };
        
        testView.setFirst();
        $("#button-check").click(function(e){
            testView.checkClicked(e);
        });
        
        $("#button-next").click(function(e){
            testView.nextClicked(e);
        });
    
    
    });
</script>
@endsection
