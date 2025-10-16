<div class="w-full">
  {{-- Toolbar --}}
  <div id="toolbar-{{ $id ?? 'editor' }}" class="flex flex-wrap gap-2 bg-[#1f2937] p-3 rounded-t-xl items-center">
    {{-- Text style --}}
    <button data-command="bold" class="btn font-bold">B</button>
    <button data-command="italic" class="btn italic">I</button>
    <button data-command="underline" class="btn underline">U</button>

    {{-- Headings --}}
    <select data-command="heading" class="btn text-sm px-2 py-1">
      <option value="">Paragraph</option>
      <option value="h1">H1</option>
      <option value="h2">H2</option>
      <option value="h3">H3</option>
    </select>

    {{-- Font size --}}
    <select data-command="fontSize" class="btn text-sm px-2 py-1">
      <option value="">Size</option>
      <option value="12">12px</option>
      <option value="14">14px</option>
      <option value="18">18px</option>
      <option value="24">24px</option>
      <option value="32">32px</option>
    </select>

    {{-- Text color --}}
    <input type="color" data-command="color" class="btn h-7 w-7 p-0" title="Text color">

    {{-- Background color --}}
    <input type="color" data-command="bgColor" class="btn h-7 w-7 p-0" title="Background color">

    {{-- Lists --}}
    <button data-command="unorderedList" class="btn">UL</button>
    <button data-command="orderedList" class="btn">OL</button>

    {{-- Clear --}}
    <button data-command="clear" class="btn">✖</button>
  </div>

  {{-- Editor --}}
  <div id="{{ $id ?? 'editor' }}"
       contenteditable="true"
       class="min-h-[200px] bg-[#f5f5f5] text-[#1f2937] p-4 rounded-b-xl focus:outline-none"
       data-placeholder="Start writing here...">
    {!! $content ?? '' !!}
  </div>

  <input type="hidden" name="{{ $name ?? 'description' }}" id="{{ $id ?? 'editor' }}Content">
</div>

{{-- Styles --}}
<style>
  .btn {
    background: transparent;
    color: #f5f5f5;
    border: none;
    border-radius: 6px;
    padding: 6px 8px;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.2s ease, transform 0.1s ease;
  }
  .btn:hover { background: rgba(255, 255, 255, 0.1); transform: translateY(-1px); }
  .btn:active { transform: scale(0.96); }
  [contenteditable][data-placeholder]:empty:before {
    content: attr(data-placeholder);
    color: #9ca3af;
  }
</style>

{{-- Script --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
  const id = "{{ $id ?? 'editor' }}";
  const toolbar = document.getElementById(`toolbar-${id}`);
  const editor = document.getElementById(id);
  const hiddenInput = document.getElementById(`${id}Content`);

  function applyFormat(cmd, value = null) {
    const selection = window.getSelection();
    if (!selection.rangeCount) return;
    const range = selection.getRangeAt(0);
    if (selection.isCollapsed) return;

    // helpers
    const wrap = tag => {
      const el = document.createElement(tag);
      try {
        range.surroundContents(el);
      } catch (e) {
        const frag = range.extractContents();
        el.appendChild(frag);
        range.insertNode(el);
      }
    };

    switch (cmd) {
      case 'bold': wrap('strong'); break;
      case 'italic': wrap('em'); break;
      case 'underline': wrap('u'); break;
      case 'heading': if (value) wrap(value); break;
      case 'fontSize':
        const span = document.createElement('span');
        span.style.fontSize = value + 'px';
        range.surroundContents(span);
        break;
      case 'color':
        const colorSpan = document.createElement('span');
        colorSpan.style.color = value;
        range.surroundContents(colorSpan);
        break;
      case 'bgColor':
        const bgSpan = document.createElement('span');
        bgSpan.style.backgroundColor = value;
        range.surroundContents(bgSpan);
        break;
      case 'unorderedList': wrapList('ul'); break;
      case 'orderedList': wrapList('ol'); break;
      case 'clear': editor.innerHTML = editor.textContent; break;
    }

    hiddenInput.value = editor.innerHTML;
  }

  function wrapList(type) {
    const selection = window.getSelection();
    if (!selection.rangeCount) return;
    const range = selection.getRangeAt(0);
    const list = document.createElement(type);
    const li = document.createElement('li');
    li.appendChild(range.extractContents());
    list.appendChild(li);
    range.insertNode(list);
  }

  toolbar.querySelectorAll('.btn, select, input[type="color"]').forEach(el => {
    el.addEventListener('click', e => e.preventDefault());
    el.addEventListener('change', e => {
      const cmd = e.target.dataset.command;
      const val = e.target.value || null;
      applyFormat(cmd, val);
    });
    el.addEventListener('mousedown', e => e.preventDefault());
    el.addEventListener('mouseup', e => {
      if (el.tagName === 'BUTTON') applyFormat(el.dataset.command);
    });
  });

  editor.addEventListener('input', () => hiddenInput.value = editor.innerHTML);
});
</script>
