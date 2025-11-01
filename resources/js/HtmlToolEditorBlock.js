export default class HtmlTool{
  constructor({ data }) {
    this.data = data || { html: '' };
  }

  static get toolbox() {
    return { title: 'HTML', icon: '<>' };
  }

  render() {
    this.wrapper = document.createElement('div');

    this.textarea = document.createElement('textarea');
    this.textarea.placeholder = 'Write your HTML code here...';
    this.textarea.classList.add('cdx-input');
    this.textarea.style.height = "70px";
    this.textarea.value = this.data.value || '';
    this.textarea.addEventListener('input', () => this.updatePreview());

    this.preview = document.createElement('div');
    this.preview.classList.add('html-preview');
    this.preview.style.borderRadius = '5px';
    this.preview.style.padding = '10px';
    this.preview.style.marginTop = '10px';
    this.preview.innerHTML = this.data.value || '';
    this.wrapper.append(this.textarea, this.preview);
    return this.wrapper;
  }

  updatePreview() {
    this.preview.innerHTML = this.textarea.value;
  }

  save() {
    return { value: this.textarea.value };
  }
}