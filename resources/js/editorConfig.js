import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import EditorjsList from "@editorjs/list";
import InlineCode from "@editorjs/inline-code";
import ImageTool from "@editorjs/image";
import Table from "@editorjs/table";
import Quote from "@editorjs/quote";
import CodeTool from "@editorjs/code";
import Embed from "@editorjs/embed";
import Underline from "@editorjs/underline";
import LinkTool from "@editorjs/link";
import Marker from "@editorjs/marker";
import AttachesTool from "@editorjs/attaches";
import TextStyleTool from "@skchawala/editorjs-text-style";
import Accordion from "editorjs-collapsible-block";
import Strikethrough from '@sotaproject/strikethrough';
import { StyleInlineTool } from "editorjs-style"; 'editorjs-style';
import EmojiPickerTool from '@plebjs/editorjs-emoji-picker-tool';


const editorjs = document.querySelector('#editorjs')

class HtmlViewTool {
  static get toolbox() {
    return { title: 'HTML', icon: '<>' };
  }

  render() {
    this.wrapper = document.createElement('div');

    this.textarea = document.createElement('textarea');
    this.textarea.placeholder = 'Write your HTML code here...';
    this.textarea.classList.add('cdx-input');
    this.textarea.style.height = "70px";
    this.textarea.addEventListener('input', () => this.updatePreview());

    this.preview = document.createElement('div');
    this.preview.classList.add('html-preview');
    this.preview.style.borderRadius = '5px';
    this.preview.style.padding = '10px';
    this.preview.style.marginTop = '10px';

    this.wrapper.append(this.textarea, this.preview);
    return this.wrapper;
  }

  updatePreview() {
    this.preview.innerHTML = this.textarea.value;
  }

  save() {
    return { html: this.textarea.value };
  }

  renderSaved(data) {
    const div = document.createElement('div');
    div.innerHTML = data.html;
    return div;
  }
}

if(editorjs){
    window.editor = new EditorJS({
        holder: "editorjs",
        tools: {
            header: {
                class: Header,
                shortcut: "CMD+SHIFT+H",
            },
            List: {
                class: EditorjsList,
                inlineToolbar: true,
                config: {
                    defaultStyle: "unordered",
                },
            },
            inlineCode: {
                class: InlineCode,
                shortcut: "CMD+SHIFT+M",
            },
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        byFile: "/upload-image",
                        byUrl: "/fetch-image",
                    },
                    field: "image",
                },
            },
            linkTool: {
                class: LinkTool,
                config: {
                    endpoint: "/fetch-url",
                },
            },
            table: {
                class: Table,
                inlineToolbar: true,
            },
            quote: {
                class: Quote,
                inlineToolbar: true,
                shortcut: "CMD+SHIFT+O",
                config: {
                    quotePlaceholder: "Enter a quote",
                    captionPlaceholder: "Quote's author",
                },
            },
            embed: {
                class: Embed,
                config: {
                    services: {
                        youtube: true,
                    },
                },
            },
            code: CodeTool,
            underline: Underline,
            Marker: {
                class: Marker,
                shortcut: "CMD+SHIFT+M",
            },
            attaches: {
                class: AttachesTool,
                config: {
                    endpoint: "/upload_file",
                },
            },
            textStyle: {
                class: TextStyleTool,
                config: {
                    fontSizeEnabled: true,
                    fontFamilyEnabled: true,
                    fontSizes: [
                        { label: "12px", value: "12px" },
                        { label: "14px", value: "14px" },
                        { label: "16px", value: "16px" },
                        { label: "18px", value: "18px" },
                        { label: "20px", value: "20px" },
                    ],
                    fontFamilies: [
                        { label: "Arial", value: "Arial" },
                        { label: "Georgia", value: "Georgia" },
                        { label: "Courier New", value: "Courier New" },
                        { label: "Verdana", value: "Verdana" },
                    ],
                    defaultFontSize: "20px",
                    defaultFontFamily: "Verdana",
                },
            },
            accordion: {
                class: Accordion,
                // optional config
                config: {
                    defaultExpanded: true,
                    maxBlockCount: 10,
                    disableAnimation: false,
                    overrides: {
                        styles: {
                            blockWrapper: "background-color: lightyellow;",
                            blockContent: "border-left: 2px solid #ccc;",
                            lastBlockContent: "border-bottom: 2px solid #ccc;",
                            insideContent: "padding: 10px;",
                        },
                    },
                },
            },
            emoji: {
                class: EmojiPickerTool
            },
            strikethrough: Strikethrough,
            StyleInlineTool: StyleInlineTool,
            htmlview: HtmlViewTool,
        },
        data: window.editor_content,
    });
}