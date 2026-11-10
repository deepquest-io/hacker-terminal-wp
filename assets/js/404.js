/**
 * Retro Hacker Terminal: 404 hacking simulation (vanilla JS).
 * Purely cosmetic: prints fake output into #e404Term. No network access.
 */
(function () {
  'use strict';

  var term = document.getElementById('e404Term');
  if (!term) { return; }

  var replayBtn = document.getElementById('e404Replay');
  var host = term.getAttribute('data-host') || 'localhost';
  var path = term.getAttribute('data-path') || '/';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var timers = [];
  var runId = 0;

  function rnd(a, b) { return Math.floor(Math.random() * (b - a + 1)) + a; }

  function hex(n) {
    var s = '', chars = '0123456789abcdef';
    while (n--) { s += chars.charAt(rnd(0, 15)); }
    return s;
  }

  function later(fn, ms) {
    var id = window.setTimeout(fn, ms);
    timers.push(id);
  }

  function clearAll() {
    for (var i = 0; i < timers.length; i++) { window.clearTimeout(timers[i]); }
    timers = [];
  }

  function addLine(text, cls) {
    var el = document.createElement('div');
    el.className = 'e404-line' + (cls ? ' ' + cls : '');
    el.textContent = text;
    term.appendChild(el);
    term.scrollTop = term.scrollHeight;
    return el;
  }

  function buildScript() {
    var ip = '192.0.2.' + rnd(2, 250); /* documentation range, not a real host */
    return [
      { t: 'cmd', x: 'nmap -sV -p 80,443 ' + host },
      { t: 'out', x: 'Starting scan on ' + ip + ' ...' },
      { t: 'out', x: '80/tcp   open  http' },
      { t: 'out', x: '443/tcp  open  https' },
      { t: 'cmd', x: 'curl -I ' + host + path },
      { t: 'out', x: 'HTTP/1.1 404 Not Found', c: 'err' },
      { t: 'cmd', x: './dirbuster --target ' + path + ' --wordlist common.txt' },
      { t: 'bar', x: 'bruteforcing paths', n: 4096 },
      { t: 'out', x: '[-] 0 matches in 4096 candidates', c: 'warn' },
      { t: 'cmd', x: './exploit --payload reverse_tcp --target ' + path },
      { t: 'bar', x: 'injecting payload', n: 100 },
      { t: 'out', x: '[!] segmentation fault: target does not exist', c: 'err' },
      { t: 'out', x: 'session token: ' + hex(32), c: 'dim' },
      { t: 'final' }
    ];
  }

  function barText(label, pct) {
    var width = 20, filled = Math.round(width * pct / 100), s = '';
    for (var i = 0; i < width; i++) { s += i < filled ? '#' : '.'; }
    return label + ' [' + s + '] ' + (pct < 10 ? '  ' : pct < 100 ? ' ' : '') + pct + '%';
  }

  function finish() {
    addLine('');
    addLine('ACCESS_DENIED :: 404 :: NOTHING_HERE', 'err big');
    var prompt = addLine('root@' + host + ':~# ', 'cmd');
    var cur = document.createElement('span');
    cur.className = 'e404-cursor';
    prompt.appendChild(cur);
  }

  function runStep(steps, i, id) {
    if (id !== runId) { return; }
    if (i >= steps.length) { return; }
    var s = steps[i];

    function next(delay) { later(function () { runStep(steps, i + 1, id); }, reduce ? 0 : delay); }

    if (s.t === 'cmd') {
      var line = addLine('root@' + host + ':~# ', 'cmd');
      var txt = document.createTextNode('');
      line.appendChild(txt);
      if (reduce) { txt.nodeValue = s.x; next(0); return; }
      var c = 0;
      (function type() {
        if (id !== runId) { return; }
        c++;
        txt.nodeValue = s.x.substring(0, c);
        if (c < s.x.length) { later(type, rnd(10, 32)); }
        else { next(rnd(180, 320)); }
      })();
    } else if (s.t === 'out') {
      addLine(s.x, s.c);
      next(rnd(80, 180));
    } else if (s.t === 'bar') {
      var el = addLine(barText(s.x, 0), 'bar');
      if (reduce) { el.textContent = barText(s.x, 100); next(0); return; }
      var pct = 0;
      (function tick() {
        if (id !== runId) { return; }
        pct = Math.min(100, pct + rnd(4, 13));
        el.textContent = barText(s.x, pct);
        if (pct < 100) { later(tick, rnd(50, 120)); }
        else { next(300); }
      })();
    } else {
      finish();
    }
  }

  function start() {
    clearAll();
    runId++;
    term.textContent = '';
    runStep(buildScript(), 0, runId);
  }

  if (replayBtn) { replayBtn.addEventListener('click', start); }
  start();
})();
