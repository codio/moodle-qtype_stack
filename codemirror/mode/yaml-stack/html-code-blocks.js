// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: http://codemirror.net/LICENSE

(function (mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"), require("../xml/xml"))
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror", "../xml/xml"], mod)
  else // Plain browser env
    mod(CodeMirror)
})(function (CodeMirror) {
  CodeMirror.defineMode("html-code-blocks", function (config) {
    var htmlMode = CodeMirror.getMode(config, "text/html");

    return {
      startState: function () {
        return {
          openedBlocks: 0,
          html: CodeMirror.startState(htmlMode)
        }
      },
      copyState: function (state) {
        return {
          openedBlocks: state.openedBlocks,
          html: CodeMirror.copyState(htmlMode, state.html)
        }
      },
      token: function (stream, state) {
        if (stream.match(/\[\[/)) {
          state.openedBlocks++;
          return "meta";
        }
        if (stream.match(/]]/)) {
          state.openedBlocks--;
          return "meta";
        }
        if (state.openedBlocks > 0) {
          stream.next();
          return "string"
        } else {
          return htmlMode.token(stream, state.html)
        }
      }
    }
  })
});
