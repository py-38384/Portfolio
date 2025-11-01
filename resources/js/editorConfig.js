import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import EditorjsList from "@editorjs/list";
import InlineCode from "@editorjs/inline-code";
import ImageTool from "@editorjs/image";
import Table from "@editorjs/table";
import CodeTool from "@editorjs/code";
import Embed from "@editorjs/embed";
import Underline from "@editorjs/underline";
import Marker from "@editorjs/marker";
import AttachesTool from "@editorjs/attaches";
import TextStyleTool from "@skchawala/editorjs-text-style";
import Strikethrough from '@sotaproject/strikethrough';
import { StyleInlineTool } from "editorjs-style"; 'editorjs-style';
import EmojiPickerTool from '@plebjs/editorjs-emoji-picker-tool';
import HtmlTool from "./HtmlToolEditorBlock";


const editorjs = document.querySelector('#editorjs')

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
            table: {
                class: Table,
                inlineToolbar: true,
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
                    endpoint: "/upload-file",
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
            emoji: {
                class: EmojiPickerTool
            },
            strikethrough: Strikethrough,
            StyleInlineTool: StyleInlineTool,
            html: HtmlTool,
        },
        data: window.editor_content,
    });
}