<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Gallery</div>
          <div class="panel-body">
            <dropzone id="myDropzone" 
              :url="url" 
              :parallelUploads="parallelUploads"
              :acceptedFileTypes="acceptedFileTypes"
              :maxFileSizeInMB="maxFileSizeInMB"
              :language="language"
              :headers="csrfHeader"
              :useCustomDropzoneOptions="useCustomDropzoneOptions"
              :dropzoneOptions="dropzoneOptions"
              :preview-template="template">
              <input type="hidden" name="csrf-token" :value="csrfToken">
            </dropzone>
            <div class="dropzone-previews" id="previewContainer">
            </div>

            <!-- The Modal -->
            <div id="myModal" class="modaln">
              <span class="close" v-on:click="closeModal">&times;</span>
              <img class="modaln-content" id="img01" src="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

.modaln {
    display: none; 
    position: fixed;
    z-index: 30;
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.9);
}

.modaln-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 500px;
}

.modaln-content { 
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

@media only screen and (max-width: 700px){
    .modaln-content {
        width: 100%;
    }
}
</style>

<script>
import $ from 'jquery';

import Dropzone from 'vue2-dropzone';

export default {
  data: () => {
    return {
      url: 'upload?email=' + localStorage.getItem('email'),
      csrfToken: document.head.querySelector('meta[name="csrf-token"]').content,
      csrfHeader: {
       'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
      },
      parallelUploads: 5,
      acceptedFileTypes: 'image/jpg,image/jpeg,image/png',
      maxFileSizeInMB: 10,
      language: {dictDefaultMessage: '<br>Drop files or click to choose files..'},
      useCustomDropzoneOptions: true,
      dropzoneOptions: { 
        previewsContainer: '#previewContainer',
        clickable: true,
        addRemoveLinks: true
      },
    }
  },
  components: {
    Dropzone
  },
  methods: {
    openModal: function (event) {
      $('#myModal').css('display', 'block');
      $('#img01').attr('src', this.src);
    },
    closeModal: function (event) {
      $('#myModal').css('display', 'none');
    },
    template: function() {
      return `
        <div class="dz-preview dz-file-preview">
            <div class="dz-image" style="width: 200px;height: 200px">
                <img data-dz-thumbnail /></div>
            <div class="dz-details">
              <div class="dz-size"><span data-dz-size></span></div>
              <div class="dz-filename"><span data-dz-name></span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
            <div class="dz-success-mark"><i class="fa fa-check"></i></div>
            <div class="dz-error-mark"><i class="fa fa-close"></i></div>
            <a style="margin-bottom: 40px;" 
              class="dz-remove" 
              href="javascript:undefined;"
              onClick="$('#myModal').css('display', 'block');
                var image = $(this).parent().children().children()[0].currentSrc;
                $('#img01').attr('src', image);">View</a>
        </div>`;
    }
  }
}
</script>
