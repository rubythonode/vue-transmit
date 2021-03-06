<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible"
        content="ie=edge">
  <title>Vue Dropzone Test</title>
  <script src="https://unpkg.com/vue"></script>
  <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
        integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
        crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
          integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
          integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
          crossorigin="anonymous"></script>
  <script>
    <?= file_get_contents(__DIR__. "/../dist/vue-transmit.browser.js" ); ?>

    ;Vue.use(VueTransmit)
  </script>
  <style>
    <?= file_get_contents(__DIR__. "/../dist/vue-transmit.css" ); ?>
  </style>
</head>

<body>
  <main id="root" class="mt-5">
    <div class="container">
      <div class="row">
        <header class="col-10 push-1 text-center">
          <h1 class="mb-5"><code>&lt;vue-transmit&gt;</code></h1>
        </header>
        <vue-transmit class="col-10 push-1"
                      tag="section"
                      v-bind="options"
                      drop-zone-classes="bg-faded"
                      ref="uploader">
          <div class="d-flex align-items-center justify-content-center w-100"
                style="height:50vh; border-radius: 1rem;">
            <button class="btn btn-primary"
                    @click="triggerBrowse">Upload Files</button>
          </div>
          <template slot="files" scope="props">
            <div v-for="(file, i) in props.files" :key="file.id" :class="{'mt-5': i===0}">
              <div class="media">
                <img :src="file.dataUrl" class="img-fluid d-flex mr-3">
                <div class="media-body">
                  <h3>{{ file.name }}</h3>
                  <div class="progress" style="width: 50vw;">
                    <div class="progress-bar bg-success"
                        :style="{width: file.upload.progress + '%'}"></div>
                  </div>
                  <pre>{{ file | json }} </pre>
                </div>
              </div>
            </div>
          </template>
        </vue-transmit>
      </div>
    </div>
  </main>

  <script>
    Vue.use(VueTransmit)
    window.app = new Vue({
      el: '#root',
      data: {
        options: {
          acceptedFileTypes: ['image/*'],
          url: './upload.php',
          clickable: false
        }
      },
      methods: {
        triggerBrowse() {
          this.$refs.uploader.triggerBrowseFiles()
        },
      },
      filters: {
        json(value) {
          return JSON.stringify(value, null, 2)
        }
      }
    })
  </script>
</body>
</html>
