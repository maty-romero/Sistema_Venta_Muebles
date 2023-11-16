<style>
  .modal-content {
    -webkit-animation-name: slideIn;
    -webkit-animation-duration: 0.4s;
    animation-name: slideIn;
    animation-duration: 0.4s
  }

  /* The Modal (background) */
  .modal {
    -webkit-animation-name: fadeIn;
    /* Fade in the background */
    -webkit-animation-duration: 0.4s;
    animation-name: fadeIn;
    animation-duration: 0.4s
  }

  /* Add Animation */
  @-webkit-keyframes slideIn {
    from {
      bottom: -300px;
      opacity: 0
    }

    to {
      bottom: 0;
      opacity: 1
    }
  }

  @keyframes slideIn {
    from {
      bottom: -300px;
      opacity: 0
    }

    to {
      bottom: 0;
      opacity: 1
    }
  }

  @-webkit-keyframes fadeIn {
    from {
      opacity: 0
    }

    to {
      opacity: 1
    }
  }

  @keyframes fadeIn {
    from {
      opacity: 0
    }

    to {
      opacity: 1
    }
  }
</style>

<!-- Trigger/Open The Modal -->
<button id="myBtn" class='{{$clasesBtn}}'>{{$textoBtn}}</button>

<!-- The Modal -->
@if ($errors->isEmpty())
<div id="myModal" class="modal hidden fixed z-[1] left-0 top-0 w-full h-full overflow-auto bg-[rgba(0,0,0,0.4)] ">
  @else
  <div id="myModal" class="modal  fixed z-[1] left-0 top-0 w-full h-full overflow-auto bg-[rgba(0,0,0,0.4)] ">
    @endif




    <!-- Modal content -->
    <div class="modal-content bg-[#fefefe] mx-auto mt-[50px] w-[400px] shadow rounded-lg">
      <div class="modal-header text-white bg-zinc-700 h-content p-4 rounded-t-lg">
        <span class="close w-8 h-8 m-0 leading-8 text-white text-center float-right font-bold text-[28px] hover:bg-zinc-900 rounded-full hover:cursor-pointer">&times;</span>
        <h2>{{$encabezado}}</h2>
      </div>
      <div class="modal-body p-4 rounded-b-lg">
        {{$contenido}}
      </div>
    </div>
  </div>


  <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

  // Add this line to close the modal initially
  modal.style.display = "none";
  </script>