/**
 * Retro Hacker Terminal — Main JS (vanilla, no jQuery)
 * v1.9.1
 */
(function () {
  'use strict';

  /* ─── MOBILE NAV TOGGLE ─── */
  var menuToggle = document.querySelector('.menu-toggle');
  var mainNav    = document.querySelector('.main-navigation');

  if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', function () {
      var isOpen = mainNav.classList.toggle('toggled');
      menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      menuToggle.textContent = isOpen ? 'CLOSE_MENU' : 'OPEN_MENU';
    });

    document.addEventListener('click', function (e) {
      if (!mainNav.contains(e.target) && !menuToggle.contains(e.target)) {
        mainNav.classList.remove('toggled');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.textContent = 'OPEN_MENU';
      }
    });

    window.addEventListener('resize', function () {
      if (window.innerWidth > 900) {
        mainNav.classList.remove('toggled');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.textContent = 'OPEN_MENU';
      }
    });
  }

  /* ─── NAV SEARCH TOGGLE ─── */
  var searchToggle = document.getElementById('navSearchToggle');
  var searchForm   = document.getElementById('navSearchForm');
  var searchInput  = document.getElementById('navSearchInput');

  if (searchToggle && searchForm) {
    searchToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      var isOpen = searchForm.classList.toggle('is-open');
      searchToggle.textContent = isOpen ? '[CLOSE_]' : '[SEARCH_]';
      if (isOpen && searchInput) setTimeout(function () { searchInput.focus(); }, 50);
    });

    document.addEventListener('click', function (e) {
      if (!searchForm.contains(e.target) && e.target !== searchToggle) {
        searchForm.classList.remove('is-open');
        searchToggle.textContent = '[SEARCH_]';
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        searchForm.classList.remove('is-open');
        searchToggle.textContent = '[SEARCH_]';
      }
    });
  }

  /* ─── TERMINAL TYPING EFFECT ─── */
  var cmdEl = document.getElementById('terminal-cmd');
  if (cmdEl) {
    var commands = [
      'cat /proc/version','ls -la /var/www/',
      'grep -r "error" ./logs','nmap -sV target.host',
      'tail -f /var/log/apache2/access.log',
      'find / -name "*.conf" 2>/dev/null',
      'ping -c 4 8.8.8.8','whoami','uname -a',
      'netstat -an | grep LISTEN',
    ];
    var cmdIdx=0,charIdx=0,typing=true,paused=0;
    function typeStep(){
      if(paused>0){paused--;setTimeout(typeStep,80);return;}
      var cmd=commands[cmdIdx];
      if(typing){
        if(charIdx<cmd.length){cmdEl.textContent=cmd.substring(0,++charIdx);setTimeout(typeStep,55+Math.random()*55);}
        else{typing=false;paused=18;setTimeout(typeStep,80);}
      } else {
        if(charIdx>0){cmdEl.textContent=cmd.substring(0,--charIdx);setTimeout(typeStep,28);}
        else{typing=true;cmdIdx=(cmdIdx+1)%commands.length;paused=6;setTimeout(typeStep,80);}
      }
    }
    setTimeout(typeStep,1200);
  }

  /* ─── LIVE FOOTER CLOCK ─── */
  var clockEl = document.getElementById('footerClock');
  if(clockEl){
    function updateClock(){
      var n=new Date();
      clockEl.textContent=String(n.getUTCHours()).padStart(2,'0')+':'+String(n.getUTCMinutes()).padStart(2,'0')+':'+String(n.getUTCSeconds()).padStart(2,'0')+' UTC';
    }
    updateClock();setInterval(updateClock,1000);
  }

  /* ─── CRT GLITCH ─── */
  function randomGlitch(){
    setTimeout(function(){
      document.body.style.filter='brightness(1.4) contrast(1.1)';
      setTimeout(function(){document.body.style.filter='';
        setTimeout(function(){document.body.style.filter='brightness(0.7)';
          setTimeout(function(){document.body.style.filter='';randomGlitch();},60);
        },40);
      },80);
    },9000+Math.random()*18000);
  }
  randomGlitch();

  /* ─── BOOT FADE-IN ─── */
  document.body.style.opacity='0';
  document.body.style.transition='opacity 0.4s ease';
  window.addEventListener('load',function(){document.body.style.opacity='1';});

})();
