<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Post Create') }}
    </h2>
  </x-slot>
  <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/github-markdown-css/github-markdown.css">
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form method="POST" action="{{ route('posts.store') }}">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-800  text-gray-800 dark:text-gray-200">
          <div class="p-6">
            @csrf
            <div>
              <div>
                <label for="name">Title:</label>
              </div>
              <input type="text" name="title" id="title" class="text-black border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            </div>
            <div>
              <label for="category_id">Category:</label>
            </div>
            <select name="category_id" id="category" class="text-black border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
              @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
            <div>
              <label for="image">Image:</label>
            </div>
            <input type="file" name="image" id="image" class="text-black border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <div id="image-preview"></div>
            <div class="mt-3">
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Save
              </button>
            </div>
          </div>
        </div>
        <div class="mt-4 bg-white overflow-hidden shadow-xl sm:rounded-lg dark:bg-gray-800  text-gray-800 dark:text-gray-200">
          <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
              <textarea name="text" id="text" class="text-black border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"></textarea>
            </div>
            <div class="col-span-2">
              <div id="preview" class="markdown-body"></div>
            </div>
          </div>
        </div>
    </div>
    </form>
  </div>
  </div>
  <style>
    #image-preview {
      max-width: 100%;
      border-radius: 0.5rem;
      padding: .5rem;
      border: 1px solid #e5e7eb;
      margin-top: 2rem;
    }
    #image-preview img {
      border-radius: 0.5rem;
    }
  </style>
  <script>
    $('#text').on('input', function(e) {
      document.getElementById('preview').innerHTML =
        marked.parse(e.target.value);
    });
    $('#text').trigger('input');

    // render image preview
    $('#image').on('change', function(e) {
      const file = e.target.files[0];
      const reader = new FileReader();
      reader.onload = function(e) {
        $('#image-preview').html(
          `<img src="${e.target.result}" class="w-1/4" />`
        );
      };
      reader.readAsDataURL(file);
    });

    $('#image').trigger('change');
  </script>
  <script>
    // Configure marked.js to use highlight.js for code blocks
    marked.setOptions({
      highlight: function(code, lang) {
        const language = hljs.getLanguage(lang) ? lang : 'plaintext';
        return hljs.highlight(code, {
          language
        }).value;
      }
    });

    $('#text').on('input', function(e) {
      document.getElementById('preview').innerHTML =
        marked.parse(e.target.value);
      // Apply syntax highlighting to all code blocks in the preview
      document.querySelectorAll('pre code').forEach((block) => {
        hljs.highlightBlock(block);
      });
    });

    // Trigger the input event on page load to immediately show the preview
    $('#text').trigger('input');
  </script>
</x-app-layout>