# Vue-Transmit

[![npm version](https://badge.fury.io/js/vue-transmit.svg)](https://badge.fury.io/js/vue-transmit)
[![npm downloads](https://img.shields.io/npm/dt/vue-transmit.svg)](https://www.npmjs.com/package/vue-transmit)
[![GitHub issues](https://img.shields.io/github/issues/alexsasharegan/vue-transmit.svg?style=flat)](https://github.com/alexsasharegan/vue-transmit/issues)
[![GitHub stars](https://img.shields.io/github/stars/alexsasharegan/vue-transmit.svg)](https://github.com/alexsasharegan/vue-transmit/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/alexsasharegan/vue-transmit.svg)](https://github.com/alexsasharegan/vue-transmit/network)
[![Conventional Commits](https://img.shields.io/badge/Conventional%20Commits-1.0.0-yellow.svg)](https://conventionalcommits.org)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/alexsasharegan/vue-transmit.svg?style=social)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Falexsasharegan%2Fvue-transmit)

A Vue.js drag & drop uploader based on Dropzone.js (`~26kB`, `~9kB` gzipped). Many thanks to [Matias Meno](https://gitlab.com/meno/dropzone/tree/master) for paving the way with the original Dropzone.js! [Check it out](https://gitlab.com/meno/dropzone/tree/master) for any of your non-vue projects. 🙌

## Features

Vue-Transmit is a fork of Dropzone.js that has been completely rewritten in ES6 and Vue.js. Instead of creating a Vue wrapper component that duplicates all of the methods and event logic from Dropzone, Vue-Transmit implements them directly on the component. This cuts down on library size, and since Vue already has a first-class event emitter, we get even more space savings.

Also, a special File class has been written (`VTransmitFile`) to add useful information not present in the native File object (dimensions, upload stats, etc.). This is necessary for Vue to register these files reactively, since the native File object's properties are read-only.

- HTML 5 file uploads
- Completely written in Vue.js&mdash;no wrapper components
- Emits upload lifecycle events (accepted, sending, progress, success, etc.)
- Image thumbnail previews
- Support for concurrent uploads
- Scoped slots allow for fully customizable styling

![upload-example](./docs/vue-transmit-10fps.gif)

## Props: <code>&lt;vue-transmit&gt;</code>

|Property|Type|Default|
|---|---|---|
|tag|String|"div"|
|uploadAreaClasses|Array, Object, String|null|
|url|String|undefined|
|method|String|"post"|
|withCredentials|Boolean|false|
|timeout|Number|0|
|maxConcurrentUploads|Number|2|
|uploadMultiple|Boolean|false|
|maxFileSize|Number|256|
|paramName|String|"file"|
|createImageThumbnails|Boolean|true|
|maxThumbnailFileSize|Number|10|
|thumbnailWidth|Number|120|
|thumbnailHeight|Number|120|
|fileSizeBase|Number|1000|
|maxFiles|Number|null|
|params|Object|default|
|headers|Object|default|
|clickable|Boolean|true|
|ignoreHiddenFiles|Boolean|true|
|acceptedFileTypes|Array|default|
|autoProcessQueue|Boolean|true|
|autoQueue|Boolean|true|
|capture|String|null|
|renameFile|Function|identity|
|dictFileTooBig|String|"File is too big ({{ fileSize }}MiB). Max file size: {{ maxFileSize }}MiB."|
|dictInvalidFileType|String|"You can't upload files of this type."|
|dictResponseError|String|"Server responded with {{ statusCode }} code."|
|dictMaxFilesExceeded|String|"You can not upload any more files."|
|accept|Function|default|
|resize|Function|default|

## Events

|Event|Arguments|Description|
|---|---|---|
|`drop`| `DragEvent` | The `drop` event is fired when an data transfer is dropped on the drop target. |
|`drag-start`| `DragEvent` | The `drag-start` event is fired when the user starts dragging an element or text selection. |
|`drag-end`| `DragEvent` | The `drag-end` event is fired when a drag operation is being ended (by releasing a mouse button or hitting the escape key). |
|`drag-enter`| `DragEvent` | The `drag-enter` event is fired when a dragged element or text selection enters a valid drop target. |
|`drag-over`| `DragEvent` | The `drag-over` event is fired when an element or text selection is being dragged over a valid drop target (every few hundred milliseconds). |
|`drag-leave`| `DragEvent` | The `drag-leave` event is fired when a dragged element or text selection leaves a valid drop target. |
|`added-file`| `VTransmitFile` | Fired on change from the hidden file input after the Native File has been copied to VTransmitFile and added to the component data. _(status: 'added')_ |
|`added-files`| `VTransmitFile[]` | Fired on change from the hidden file input after the Native Files have been copied to VTransmitFiles and added to the component data. _(status: 'added')_ |
|`removed-file`| `VTransmitFile` | Fired on the removal of a file. |
|`thumbnail`| `VTransmitFile, Blob\|URL` | Fires on creation of a thumbnail. |
|`error`| `VTransmitFile, message: String, XmlHttpRequest` | Fired on an ajax upload error. _(status: 'error')_ |
|`error-multiple`| `VTransmitFile[], message: String, XmlHttpRequest` | Fired on an ajax upload error. _(status: 'error')_ |
|`processing`| `VTransmitFile` | Fired after the status is changed to `'uploading'`, right before the ajax request. |
|`processing-multiple`| `VTransmitFile[]` | Fired after the status is changed to `'uploading'`, right before the ajax request. |
|`upload-progress`| `VTransmitFile, progress: Number, bytesSent: Number` | Fired on progress of the XHR. |
|`total-upload-progress`| `VTransmitFile, totalUploadProgress: Number` | Fired directly after `upload-progress`. |
|`sending`| `VTransmitFile, XmlHttpRequest, FormData` | Fired right before the XHR is sent. |
|`sending-multiple`| `VTransmitFile[], XmlHttpRequest, FormData` | Fired right before the XHR is sent. |
|`success`| `VTransmitFile, response: String, LoadEvent` | Fired on load of the XHR. |
|`success-multiple`| `VTransmitFile[], response: String, LoadEvent` | Fired on load of the XHR.|
|`timeout`| `VTransmitFile, TimeoutEvent, XmlHttpRequest`| Fired on timeout of the XHR.|
|`timeout-multiple`| `VTransmitFile[], TimeoutEvent, XmlHttpRequest`| Fired on timeout of the XHR.|
|`canceled`| `VTransmitFile` | Fired upon cancellation of the XHR. _(status: 'canceled')_ |
|`canceled-multiple`| `VTransmitFile[]` | Fired upon cancellation of the XHR. _(status: 'canceled')_ |
|`complete`| `VTransmitFile` | Fired upon completion of the XHR. _(success or failure)_ |
|`complete-multiple`| `VTransmitFile[]` | Fired upon completion of the XHR. _(success or failure)_ |
|`reset`| n/a | Fired when all files have been removed. |
|`max-files-exceeded`| `VTransmitFile` | Fired if a file is added that exceeds the max files prop. |
|`max-files-reached`| `VTransmitFile[]` | Fired when the total accepted files on the instance exceeds the max files prop. |
|`queue-complete`| `VTransmitFile` | Fired once all added files have uploaded and the queue has been flushed.  |

## Slots

### Default (`$slots.default`)

The default slot should contain your markup for getting an upload started. This could be a file uploader button and/or a dropzone.

### Files (Scoped, `$slots.files`)

This slot receives a number of props:

```ts
{
  files: VTransmitFile[],
  acceptedFiles: VTransmitFile[],
  rejectedFiles: VTransmitFile[],
  addedFiles: VTransmitFile[],
  queuedFiles: VTransmitFile[],
  uploadingFiles: VTransmitFile[],
  activeFiles: VTransmitFile[],
  isUploading: Boolean
}
```

## `VTransmitFile`

```json
{
  "_nativeFile": {},
  "id": "v-transmit-file-1",
  "accepted": true,
  "lastModified": 1478117443000,
  "lastModifiedDate": "2016-11-02T20:10:43.000Z",
  "name": "cosmo.jpg",
  "processing": true,
  "size": 142776,
  "status": "success",
  "type": "image/jpeg",
  "upload": {
    "bytesSent": 142776,
    "progress": 100,
    "speed": {
      "kbps": 10.06,
      "mbps": 0.01
    },
    "start": 1503273157993,
    "end": 1503273158029,
    "time": 0.036,
    "total": 142776
  },
  "webkitRelativePath": "",
  "width": 700,
  "height": 700,
  "xhr": {},
  "dataUrl": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAYAAAA5ZDbSAAAgAElEQVR4XlS9B7RmZ3UluG/...=",
}
```

## Usage

```html
<template>
  <main id="root" class="mt-5">
    <div class="container">
      <div class="row">
        <header class="col-12 text-center">
          <h1 class="mb-5"><code>&lt;vue-transmit&gt;</code></h1>
        </header>
        <vue-transmit class="col-12"
                      tag="section"
                      v-bind="options"
                      drop-zone-classes="bg-faded"
                      ref="uploader"
                      >
          <div class="d-flex align-items-center justify-content-center w-100"
                style="height:50vh; border-radius: 1rem;">
            <button class="btn btn-primary"
                    @click="triggerBrowse">Upload Files</button>
          </div>
          <template slot="files" scope="props">
            <div v-for="(file, i) in props.files" :key="file.id" :class="{'mt-5': i === 0}">
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
</template>

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
```
