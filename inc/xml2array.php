





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  <link rel="dns-prefetch" href="https://assets-cdn.github.com">
  <link rel="dns-prefetch" href="https://avatars0.githubusercontent.com">
  <link rel="dns-prefetch" href="https://avatars1.githubusercontent.com">
  <link rel="dns-prefetch" href="https://avatars2.githubusercontent.com">
  <link rel="dns-prefetch" href="https://avatars3.githubusercontent.com">
  <link rel="dns-prefetch" href="https://github-cloud.s3.amazonaws.com">
  <link rel="dns-prefetch" href="https://user-images.githubusercontent.com/">



  <link crossorigin="anonymous" media="all" integrity="sha512-ffMzRgUi/mtdt6xiC1jtSP1kZPeTBajWgak1AnijhQVTr6eCui3vcdxCvFCJjbjAXg730wT/i/rceI+PIwS6kQ==" rel="stylesheet" href="https://assets-cdn.github.com/assets/frameworks-c4bbb32afb602dcf8c75be0bc4c83014.css" />
  <link crossorigin="anonymous" media="all" integrity="sha512-WZklPJpB37+ljTfVNn0494msEFLupIvcsVPpv1UCNJvCJAf0oFgpGlw4+OV4hQ3WMFTKbmuSVLk6uMmWuhnuqQ==" rel="stylesheet" href="https://assets-cdn.github.com/assets/github-0c21e211e4fd150ac107ccf0fcf751e5.css" />
  
  
  
  

  <meta name="viewport" content="width=device-width">
  
  <title>php-sdk/xml2array.php at master · andris9/php-sdk</title>
    <meta name="description" content="GitHub is where people build software. More than 27 million people use GitHub to discover, fork, and contribute to over 80 million projects.">
  <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub">
  <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub">
  <meta property="fb:app_id" content="1401488693436528">

    
    <meta property="og:image" content="https://avatars0.githubusercontent.com/u/132242?s=400&amp;v=4" /><meta property="og:site_name" content="GitHub" /><meta property="og:type" content="object" /><meta property="og:title" content="andris9/php-sdk" /><meta property="og:url" content="https://github.com/andris9/php-sdk" /><meta property="og:description" content="Contribute to php-sdk development by creating an account on GitHub." />

  <link rel="assets" href="https://assets-cdn.github.com/">
  <link rel="web-socket" href="wss://live.github.com/_sockets/VjI6MjYyOTAzMjUzOjcxMTI2ZjBiN2IzNjk3MzdjNTRmMDJmYWQ5ODc5YmMxZTdhODExZjg3YmQwMmYzMTQ3MGUyZTMyNTZlYzI0YWU=--c6954366e04592abd05cd0becf1bc0531a6757f1">
  <meta name="pjax-timeout" content="1000">
  <link rel="sudo-modal" href="/sessions/sudo_modal">
  <meta name="request-id" content="F59A:451C:1E04466:3C3452C:5AE2420D" data-pjax-transient>


  

  <meta name="selected-link" value="repo_source" data-pjax-transient>

    <meta name="google-site-verification" content="KT5gs8h0wvaagLKAVWq8bbeNwnZZK1r1XQysX3xurLU">
  <meta name="google-site-verification" content="ZzhVyEFwb7w3e0-uOTltm8Jsck2F5StVihD0exw2fsA">
  <meta name="google-site-verification" content="GXs5KoUUkNCoaAZn7wPN-t01Pywp9M3sEjnt_3_ZWPc">
    <meta name="google-analytics" content="UA-3769691-2">

<meta name="octolytics-host" content="collector.githubapp.com" /><meta name="octolytics-app-id" content="github" /><meta name="octolytics-event-url" content="https://collector.githubapp.com/github-external/browser_event" /><meta name="octolytics-dimension-request_id" content="F59A:451C:1E04466:3C3452C:5AE2420D" /><meta name="octolytics-dimension-region_edge" content="iad" /><meta name="octolytics-dimension-region_render" content="iad" /><meta name="octolytics-actor-id" content="32423971" /><meta name="octolytics-actor-login" content="r00tmebaby" /><meta name="octolytics-actor-hash" content="425b8fc8e790238ef54f49a4030741335a6d60e031a092d9c4f005104617ded5" />
<meta name="analytics-location" content="/&lt;user-name&gt;/&lt;repo-name&gt;/blob/show" data-pjax-transient="true" />




  <meta class="js-ga-set" name="dimension1" content="Logged In">


  

      <meta name="hostname" content="github.com">
    <meta name="user-login" content="r00tmebaby">

      <meta name="expected-hostname" content="github.com">
    <meta name="js-proxy-site-detection-payload" content="Zjg0NGY5MDNkMmY2ODc2ZDdkNTYyYzE0MWZiNjgyYTM2NTRiYjM2OTM4ZGUxYTUwM2UyMDJlMjRmOTRiMDE1MHx7InJlbW90ZV9hZGRyZXNzIjoiODYuMTEuNjguNzIiLCJyZXF1ZXN0X2lkIjoiRjU5QTo0NTFDOjFFMDQ0NjY6M0MzNDUyQzo1QUUyNDIwRCIsInRpbWVzdGFtcCI6MTUyNDc3NzQ5MCwiaG9zdCI6ImdpdGh1Yi5jb20ifQ==">

    <meta name="enabled-features" content="UNIVERSE_BANNER,FREE_TRIALS,MARKETPLACE_INSIGHTS,MARKETPLACE_SELF_SERVE,MARKETPLACE_FREE_APPS,MARKETPLACE_INSIGHTS_CONVERSION_PERCENTAGES">

  <meta name="html-safe-nonce" content="4d06333fec082eaa59c76bfa7fb41aa9afed90b5">

  <meta http-equiv="x-pjax-version" content="eee99963f5afe1344f7539d60e6b1d0a">
  

      <link href="https://github.com/andris9/php-sdk/commits/master.atom" rel="alternate" title="Recent Commits to php-sdk:master" type="application/atom+xml">

  <meta name="description" content="Contribute to php-sdk development by creating an account on GitHub.">
  <meta name="go-import" content="github.com/andris9/php-sdk git https://github.com/andris9/php-sdk.git">

  <meta name="octolytics-dimension-user_id" content="132242" /><meta name="octolytics-dimension-user_login" content="andris9" /><meta name="octolytics-dimension-repository_id" content="2667071" /><meta name="octolytics-dimension-repository_nwo" content="andris9/php-sdk" /><meta name="octolytics-dimension-repository_public" content="true" /><meta name="octolytics-dimension-repository_is_fork" content="false" /><meta name="octolytics-dimension-repository_network_root_id" content="2667071" /><meta name="octolytics-dimension-repository_network_root_nwo" content="andris9/php-sdk" /><meta name="octolytics-dimension-repository_explore_github_marketplace_ci_cta_shown" content="false" />


    <link rel="canonical" href="https://github.com/andris9/php-sdk/blob/master/src/xml2array.php" data-pjax-transient>


  <meta name="browser-stats-url" content="https://api.github.com/_private/browser/stats">

  <meta name="browser-errors-url" content="https://api.github.com/_private/browser/errors">

  <link rel="mask-icon" href="https://assets-cdn.github.com/pinned-octocat.svg" color="#000000">
  <link rel="icon" type="image/x-icon" class="js-site-favicon" href="https://assets-cdn.github.com/favicon.ico">

<meta name="theme-color" content="#1e2327">


  <meta name="u2f-support" content="true">

<link rel="manifest" href="/manifest.json" crossOrigin="use-credentials">

  </head>

  <body class="logged-in env-production page-blob">
    

  <div class="position-relative js-header-wrapper ">
    <a href="#start-of-content" tabindex="1" class="p-3 bg-blue text-white show-on-focus js-skip-to-content">Skip to content</a>
    <div id="js-pjax-loader-bar" class="pjax-loader-bar"><div class="progress"></div></div>

    
    
    



        
<header class="Header  f5" role="banner">
  <div class="d-flex flex-justify-between px-3 container-lg">
    <div class="d-flex flex-justify-between ">
      <div class="">
        <a class="header-logo-invertocat" href="https://github.com/" data-hotkey="g d" aria-label="Homepage" data-ga-click="Header, go to dashboard, icon:logo">
  <svg height="32" class="octicon octicon-mark-github" viewBox="0 0 16 16" version="1.1" width="32" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
</a>

      </div>

    </div>

    <div class="HeaderMenu d-flex flex-justify-between flex-auto">
      <div class="d-flex">
            <div class="">
              <div class="header-search scoped-search site-scoped-search js-site-search" role="search">
  <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="js-site-search-form" data-scoped-search-url="/andris9/php-sdk/search" data-unscoped-search-url="/search" action="/andris9/php-sdk/search" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
    <label class="form-control header-search-wrapper  js-chromeless-input-container">
          <a class="header-search-scope no-underline" href="/andris9/php-sdk/blob/master/src/xml2array.php">This repository</a>
      <input type="text"
        class="form-control header-search-input  js-site-search-focus js-site-search-field is-clearable"
        data-hotkey="s,/"
        name="q"
        value=""
        placeholder="Search"
        aria-label="Search this repository"
        data-unscoped-placeholder="Search GitHub"
        data-scoped-placeholder="Search"
        autocapitalize="off"
        >
        <input type="hidden" class="js-site-search-type-field" name="type" >
    </label>
</form></div>

            </div>

          <ul class="d-flex pl-2 flex-items-center text-bold list-style-none" role="navigation">
            <li>
              <a class="js-selected-navigation-item HeaderNavlink px-2" data-hotkey="g p" data-ga-click="Header, click, Nav menu - item:pulls context:user" aria-label="Pull requests you created" data-selected-links="/pulls /pulls/assigned /pulls/mentioned /pulls" href="/pulls">
                Pull requests
</a>            </li>
            <li>
              <a class="js-selected-navigation-item HeaderNavlink px-2" data-hotkey="g i" data-ga-click="Header, click, Nav menu - item:issues context:user" aria-label="Issues you created" data-selected-links="/issues /issues/assigned /issues/mentioned /issues" href="/issues">
                Issues
</a>            </li>
                <li>
                  <a class="js-selected-navigation-item HeaderNavlink px-2" data-ga-click="Header, click, Nav menu - item:marketplace context:user" data-octo-click="marketplace_click" data-octo-dimensions="location:nav_bar, group:" data-selected-links=" /marketplace" href="/marketplace">
                    Marketplace
</a>                </li>
            <li>
              <a class="js-selected-navigation-item HeaderNavlink px-2" data-ga-click="Header, click, Nav menu - item:explore" data-selected-links="/explore /trending /trending/developers /integrations /integrations/feature/code /integrations/feature/collaborate /integrations/feature/ship showcases showcases_search showcases_landing /explore" href="/explore">
                Explore
</a>            </li>
          </ul>
      </div>

      <div class="d-flex">
        
<ul class="user-nav d-flex flex-items-center list-style-none" id="user-links">
  <li class="dropdown js-menu-container">
    <span class="d-inline-block  px-2">
      
    <a aria-label="You have no unread notifications" class="notification-indicator tooltipped tooltipped-s  js-socket-channel js-notification-indicator" data-hotkey="g n" data-ga-click="Header, go to notifications, icon:read" data-channel="notification-changed:32423971" href="/notifications">
        <span class="mail-status "></span>
        <svg class="octicon octicon-bell" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M14 12v1H0v-1l.73-.58c.77-.77.81-2.55 1.19-4.42C2.69 3.23 6 2 6 2c0-.55.45-1 1-1s1 .45 1 1c0 0 3.39 1.23 4.16 5 .38 1.88.42 3.66 1.19 4.42l.66.58H14zm-7 4c1.11 0 2-.89 2-2H5c0 1.11.89 2 2 2z"/></svg>
</a>
    </span>
  </li>

  <li class="dropdown js-menu-container">
    <details class="dropdown-details details-reset js-dropdown-details d-flex px-2 flex-items-center">
      <summary class="HeaderNavlink"
         aria-label="Create new…"
         data-ga-click="Header, create new, icon:add">
        <svg class="octicon octicon-plus float-left mr-1 mt-1" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 9H7v5H5V9H0V7h5V2h2v5h5z"/></svg>
        <span class="dropdown-caret mt-1"></span>
      </summary>

      <ul class="dropdown-menu dropdown-menu-sw">
        
<a class="dropdown-item" href="/new" data-ga-click="Header, create new repository">
  New repository
</a>

  <a class="dropdown-item" href="/new/import" data-ga-click="Header, import a repository">
    Import repository
  </a>

<a class="dropdown-item" href="https://gist.github.com/" data-ga-click="Header, create new gist">
  New gist
</a>

  <a class="dropdown-item" href="/organizations/new" data-ga-click="Header, create new organization">
    New organization
  </a>



  <div class="dropdown-divider"></div>
  <div class="dropdown-header">
    <span title="andris9/php-sdk">This repository</span>
  </div>
    <a class="dropdown-item" href="/andris9/php-sdk/issues/new" data-ga-click="Header, create new issue">
      New issue
    </a>

      </ul>
    </details>
  </li>

  <li class="dropdown js-menu-container">

    <details class="dropdown-details details-reset js-dropdown-details d-flex pl-2 flex-items-center">
      <summary class="HeaderNavlink name mt-1"
        aria-label="View profile and more"
        data-ga-click="Header, show menu, icon:avatar">
        <img alt="@r00tmebaby" class="avatar float-left mr-1" src="https://avatars2.githubusercontent.com/u/32423971?s=40&amp;v=4" height="20" width="20">
        <span class="dropdown-caret"></span>
      </summary>

      <ul class="dropdown-menu dropdown-menu-sw">
        <li class="dropdown-header header-nav-current-user css-truncate">
          Signed in as <strong class="css-truncate-target">r00tmebaby</strong>
        </li>

        <li class="dropdown-divider"></li>

        <li><a class="dropdown-item" href="/r00tmebaby" data-ga-click="Header, go to profile, text:your profile">
          Your profile
        </a></li>
        <li><a class="dropdown-item" href="/r00tmebaby?tab=stars" data-ga-click="Header, go to starred repos, text:your stars">
          Your stars
        </a></li>
          <li><a class="dropdown-item" href="https://gist.github.com/" data-ga-click="Header, your gists, text:your gists">Your gists</a></li>

        <li class="dropdown-divider"></li>

        <li><a class="dropdown-item" href="https://help.github.com" data-ga-click="Header, go to help, text:help">
          Help
        </a></li>

        <li><a class="dropdown-item" href="/settings/profile" data-ga-click="Header, go to settings, icon:settings">
          Settings
        </a></li>

        <li><!-- '"` --><!-- </textarea></xmp> --></option></form><form class="logout-form" action="/logout" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="mDGRPgC7kdh3twzDsHZ2vrYMJKaOE3RaUeL110G3prKmpbLhKuzyUAJUlm2dDYVSm0MA7qorlIw/nNaECr7D3Q==" />
          <button type="submit" class="dropdown-item dropdown-signout" data-ga-click="Header, sign out, icon:logout">
            Sign out
          </button>
        </form></li>
      </ul>
    </details>
  </li>
</ul>



        <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="sr-only right-0" action="/logout" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="mBYAW9W4iC5IbQhto9EAY/QNJkyz+LgZCvuJSBZWgG2mgiOE/+/rpj2OksOOqvOP2UICBJfAWM9khaobXV/lAg==" />
          <button type="submit" class="dropdown-item dropdown-signout" data-ga-click="Header, sign out, icon:logout">
            Sign out
          </button>
</form>      </div>
    </div>
  </div>
</header>

      

  </div>

  <div id="start-of-content" class="show-on-focus"></div>

    <div id="js-flash-container">
</div>



  <div role="main" class="application-main ">
        <div itemscope itemtype="http://schema.org/SoftwareSourceCode" class="">
    <div id="js-repo-pjax-container" data-pjax-container >
      







  <div class="pagehead repohead instapaper_ignore readability-menu experiment-repo-nav  ">
    <div class="repohead-details-container clearfix container">

      <ul class="pagehead-actions">
  <li>
        <!-- '"` --><!-- </textarea></xmp> --></option></form><form data-autosubmit="true" data-remote="true" class="js-social-container" action="/notifications/subscribe" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="43GfsSqh7VpZwtinv28Q/WFTpYU6aQ1ehrKOD2V6cT2aKqF0Vxo41wNbBTNfQMQETuUBni8lPz6TEo8bW2aZfA==" />      <input type="hidden" name="repository_id" id="repository_id" value="2667071" class="form-control" />

        <div class="select-menu js-menu-container js-select-menu">
          <a href="/andris9/php-sdk/subscription"
            class="btn btn-sm btn-with-count select-menu-button js-menu-target"
            role="button"
            aria-haspopup="true"
            aria-expanded="false"
            aria-label="Toggle repository notifications menu"
            data-ga-click="Repository, click Watch settings, action:blob#show">
            <span class="js-select-button">
                <svg class="octicon octicon-eye" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"/></svg>
                Watch
            </span>
          </a>
          <a class="social-count js-social-count"
            href="/andris9/php-sdk/watchers"
            aria-label="1 user is watching this repository">
            1
          </a>

        <div class="select-menu-modal-holder">
          <div class="select-menu-modal subscription-menu-modal js-menu-content">
            <div class="select-menu-header js-navigation-enable" tabindex="-1">
              <svg class="octicon octicon-x js-menu-close" role="img" aria-label="Close" viewBox="0 0 12 16" version="1.1" width="12" height="16"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/></svg>
              <span class="select-menu-title">Notifications</span>
            </div>

              <div class="select-menu-list js-navigation-container" role="menu">

                <div class="select-menu-item js-navigation-item selected" role="menuitem" tabindex="0">
                  <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
                  <div class="select-menu-item-text">
                    <input type="radio" name="do" id="do_included" value="included" checked="checked" />
                    <span class="select-menu-item-heading">Not watching</span>
                    <span class="description">Be notified when participating or @mentioned.</span>
                    <span class="js-select-button-text hidden-select-button-text">
                      <svg class="octicon octicon-eye" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"/></svg>
                      Watch
                    </span>
                  </div>
                </div>

                <div class="select-menu-item js-navigation-item " role="menuitem" tabindex="0">
                  <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
                  <div class="select-menu-item-text">
                    <input type="radio" name="do" id="do_subscribed" value="subscribed" />
                    <span class="select-menu-item-heading">Watching</span>
                    <span class="description">Be notified of all conversations.</span>
                    <span class="js-select-button-text hidden-select-button-text">
                      <svg class="octicon octicon-eye" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"/></svg>
                        Unwatch
                    </span>
                  </div>
                </div>

                <div class="select-menu-item js-navigation-item " role="menuitem" tabindex="0">
                  <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
                  <div class="select-menu-item-text">
                    <input type="radio" name="do" id="do_ignore" value="ignore" />
                    <span class="select-menu-item-heading">Ignoring</span>
                    <span class="description">Never be notified.</span>
                    <span class="js-select-button-text hidden-select-button-text">
                      <svg class="octicon octicon-mute" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8 2.81v10.38c0 .67-.81 1-1.28.53L3 10H1c-.55 0-1-.45-1-1V7c0-.55.45-1 1-1h2l3.72-3.72C7.19 1.81 8 2.14 8 2.81zm7.53 3.22l-1.06-1.06-1.97 1.97-1.97-1.97-1.06 1.06L11.44 8 9.47 9.97l1.06 1.06 1.97-1.97 1.97 1.97 1.06-1.06L13.56 8l1.97-1.97z"/></svg>
                        Stop ignoring
                    </span>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
</form>
  </li>

  <li>
    
  <div class="js-toggler-container js-social-container starring-container ">
    <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="starred js-social-form" action="/andris9/php-sdk/unstar" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="MF7bAOWkxxebrpFSkKZsDo0OE3jg4Ql7raa+XVPZvCUYzNiQm0Rg5b4oZskK/g5d7vFiKfQBRe/2TvIWNhwgWw==" />
      <input type="hidden" name="context" value="repository"></input>
      <button
        type="submit"
        class="btn btn-sm btn-with-count js-toggler-target"
        aria-label="Unstar this repository" title="Unstar andris9/php-sdk"
        data-ga-click="Repository, click unstar button, action:blob#show; text:Unstar">
        <svg class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"/></svg>
        Unstar
      </button>
        <a class="social-count js-social-count" href="/andris9/php-sdk/stargazers"
           aria-label="3 users starred this repository">
          3
        </a>
</form>
    <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="unstarred js-social-form" action="/andris9/php-sdk/star" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="6SDsdmzBdixCswGZfIcfiIe4qQEW2qTEIN7Sm5OTIzAIeGf0NGSvPcI10r7nV1wu13vYYaPM64eNIWZzMpjZ0g==" />
      <input type="hidden" name="context" value="repository"></input>
      <button
        type="submit"
        class="btn btn-sm btn-with-count js-toggler-target"
        aria-label="Star this repository" title="Star andris9/php-sdk"
        data-ga-click="Repository, click star button, action:blob#show; text:Star">
        <svg class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"/></svg>
        Star
      </button>
        <a class="social-count js-social-count" href="/andris9/php-sdk/stargazers"
           aria-label="3 users starred this repository">
          3
        </a>
</form>  </div>

  </li>

  <li>
          <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="btn-with-count" action="/andris9/php-sdk/fork" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="zHlk8ItFKrhlICId5YKYcmmGdYAEuv8YGyWBKYVCyOC6RqbQBttT1cLJh+7WvnQILW3bvcG82nRC4sDAHY/sLQ==" />
            <button
                type="submit"
                class="btn btn-sm btn-with-count"
                data-ga-click="Repository, show fork modal, action:blob#show; text:Fork"
                title="Fork your own copy of andris9/php-sdk to your account"
                aria-label="Fork your own copy of andris9/php-sdk to your account">
              <svg class="octicon octicon-repo-forked" viewBox="0 0 10 16" version="1.1" width="10" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"/></svg>
              Fork
            </button>
</form>
    <a href="/andris9/php-sdk/network" class="social-count"
       aria-label="3 users forked this repository">
      3
    </a>
  </li>
</ul>

      <h1 class="public ">
  <svg class="octicon octicon-repo" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"/></svg>
  <span class="author" itemprop="author"><a class="url fn" rel="author" href="/andris9">andris9</a></span><!--
--><span class="path-divider">/</span><!--
--><strong itemprop="name"><a data-pjax="#js-repo-pjax-container" href="/andris9/php-sdk">php-sdk</a></strong>

</h1>

    </div>
    
<nav class="reponav js-repo-nav js-sidenav-container-pjax container"
     itemscope
     itemtype="http://schema.org/BreadcrumbList"
     role="navigation"
     data-pjax="#js-repo-pjax-container">

  <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
    <a class="js-selected-navigation-item selected reponav-item" itemprop="url" data-hotkey="g c" data-selected-links="repo_source repo_downloads repo_commits repo_releases repo_tags repo_branches repo_packages /andris9/php-sdk" href="/andris9/php-sdk">
      <svg class="octicon octicon-code" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M9.5 3L8 4.5 11.5 8 8 11.5 9.5 13 14 8 9.5 3zm-5 0L0 8l4.5 5L6 11.5 2.5 8 6 4.5 4.5 3z"/></svg>
      <span itemprop="name">Code</span>
      <meta itemprop="position" content="1">
</a>  </span>

    <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
      <a itemprop="url" data-hotkey="g i" class="js-selected-navigation-item reponav-item" data-selected-links="repo_issues repo_labels repo_milestones /andris9/php-sdk/issues" href="/andris9/php-sdk/issues">
        <svg class="octicon octicon-issue-opened" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-3.14 2.56-5.7 5.7-5.7zM7 1C3.14 1 0 4.14 0 8s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7zm1 3H6v5h2V4zm0 6H6v2h2v-2z"/></svg>
        <span itemprop="name">Issues</span>
        <span class="Counter">0</span>
        <meta itemprop="position" content="2">
</a>    </span>

  <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
    <a data-hotkey="g p" itemprop="url" class="js-selected-navigation-item reponav-item" data-selected-links="repo_pulls checks /andris9/php-sdk/pulls" href="/andris9/php-sdk/pulls">
      <svg class="octicon octicon-git-pull-request" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M11 11.28V5c-.03-.78-.34-1.47-.94-2.06C9.46 2.35 8.78 2.03 8 2H7V0L4 3l3 3V4h1c.27.02.48.11.69.31.21.2.3.42.31.69v6.28A1.993 1.993 0 0 0 10 15a1.993 1.993 0 0 0 1-3.72zm-1 2.92c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zM4 3c0-1.11-.89-2-2-2a1.993 1.993 0 0 0-1 3.72v6.56A1.993 1.993 0 0 0 2 15a1.993 1.993 0 0 0 1-3.72V4.72c.59-.34 1-.98 1-1.72zm-.8 10c0 .66-.55 1.2-1.2 1.2-.65 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"/></svg>
      <span itemprop="name">Pull requests</span>
      <span class="Counter">0</span>
      <meta itemprop="position" content="3">
</a>  </span>

    <a data-hotkey="g b" class="js-selected-navigation-item reponav-item" data-selected-links="repo_projects new_repo_project repo_project /andris9/php-sdk/projects" href="/andris9/php-sdk/projects">
      <svg class="octicon octicon-project" viewBox="0 0 15 16" version="1.1" width="15" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M10 12h3V2h-3v10zm-4-2h3V2H6v8zm-4 4h3V2H2v12zm-1 1h13V1H1v14zM14 0H1a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z"/></svg>
      Projects
      <span class="Counter" >0</span>
</a>
    <a class="js-selected-navigation-item reponav-item" data-hotkey="g w" data-selected-links="repo_wiki /andris9/php-sdk/wiki" href="/andris9/php-sdk/wiki">
      <svg class="octicon octicon-book" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M3 5h4v1H3V5zm0 3h4V7H3v1zm0 2h4V9H3v1zm11-5h-4v1h4V5zm0 2h-4v1h4V7zm0 2h-4v1h4V9zm2-6v9c0 .55-.45 1-1 1H9.5l-1 1-1-1H2c-.55 0-1-.45-1-1V3c0-.55.45-1 1-1h5.5l1 1 1-1H15c.55 0 1 .45 1 1zm-8 .5L7.5 3H2v9h6V3.5zm7-.5H9.5l-.5.5V12h6V3z"/></svg>
      Wiki
</a>

  <a class="js-selected-navigation-item reponav-item" data-selected-links="repo_graphs repo_contributors dependency_graph pulse /andris9/php-sdk/pulse" href="/andris9/php-sdk/pulse">
    <svg class="octicon octicon-graph" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M16 14v1H0V0h1v14h15zM5 13H3V8h2v5zm4 0H7V3h2v10zm4 0h-2V6h2v7z"/></svg>
    Insights
</a>

</nav>


  </div>

<div class="container new-discussion-timeline experiment-repo-nav  ">
  <div class="repository-content ">

    
  <a class="d-none js-permalink-shortcut" data-hotkey="y" href="/andris9/php-sdk/blob/71933e8a60a7a8b73ce2808205aad98981cc47e5/src/xml2array.php">Permalink</a>

  <!-- blob contrib key: blob_contributors:v21:587373c30f920944d3ac8daa8d13f911 -->

  <div class="file-navigation">
    
<div class="select-menu branch-select-menu js-menu-container js-select-menu float-left">
  <button class=" btn btn-sm select-menu-button js-menu-target css-truncate" data-hotkey="w"
    
    type="button" aria-label="Switch branches or tags" aria-expanded="false" aria-haspopup="true">
      <i>Branch:</i>
      <span class="js-select-button css-truncate-target">master</span>
  </button>

  <div class="select-menu-modal-holder js-menu-content js-navigation-container" data-pjax>

    <div class="select-menu-modal">
      <div class="select-menu-header">
        <svg class="octicon octicon-x js-menu-close" role="img" aria-label="Close" viewBox="0 0 12 16" version="1.1" width="12" height="16"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/></svg>
        <span class="select-menu-title">Switch branches/tags</span>
      </div>

      <div class="select-menu-filters">
        <div class="select-menu-text-filter">
          <input type="text" aria-label="Filter branches/tags" id="context-commitish-filter-field" class="form-control js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
        </div>
        <div class="select-menu-tabs">
          <ul>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="branches" data-filter-placeholder="Filter branches/tags" class="js-select-menu-tab" role="tab">Branches</a>
            </li>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="tags" data-filter-placeholder="Find a tag…" class="js-select-menu-tab" role="tab">Tags</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="branches" role="menu">

        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <a class="select-menu-item js-navigation-item js-navigation-open selected"
               href="/andris9/php-sdk/blob/master/src/xml2array.php"
               data-name="master"
               data-skip-pjax="true"
               rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target js-select-menu-filter-text">
                master
              </span>
            </a>
        </div>

          <div class="select-menu-no-results">Nothing to show</div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="tags">
        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/andris9/php-sdk/tree/v0.1.0/src/xml2array.php"
              data-name="v0.1.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v0.1.0">
                v0.1.0
              </span>
            </a>
        </div>

        <div class="select-menu-no-results">Nothing to show</div>
      </div>

    </div>
  </div>
</div>

    <div class="BtnGroup float-right">
      <a href="/andris9/php-sdk/find/master"
            class="js-pjax-capture-input btn btn-sm BtnGroup-item"
            data-pjax
            data-hotkey="t">
        Find file
      </a>
      <clipboard-copy for="blob-path" class="btn btn-sm BtnGroup-item">
        Copy path
      </clipboard-copy>
    </div>
    <div id="blob-path" class="breadcrumb">
      <span class="repo-root js-repo-root"><span class="js-path-segment"><a data-pjax="true" href="/andris9/php-sdk"><span>php-sdk</span></a></span></span><span class="separator">/</span><span class="js-path-segment"><a data-pjax="true" href="/andris9/php-sdk/tree/master/src"><span>src</span></a></span><span class="separator">/</span><strong class="final-path">xml2array.php</strong>
    </div>
  </div>


  <include-fragment src="/andris9/php-sdk/contributors/master/src/xml2array.php" class="commit-tease">
    <div>
      Fetching contributors&hellip;
    </div>

    <div class="commit-tease-contributors">
      <img alt="" class="loader-loading float-left" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32-EAF2F5.gif" width="16" height="16" />
      <span class="loader-error">Cannot retrieve contributors at this time</span>
    </div>
</include-fragment>


  <div class="file">
    <div class="file-header">
  <div class="file-actions">

    <div class="BtnGroup">
      <a id="raw-url" class="btn btn-sm BtnGroup-item" href="/andris9/php-sdk/raw/master/src/xml2array.php">Raw</a>
        <a class="btn btn-sm js-update-url-with-hash BtnGroup-item" data-hotkey="b" href="/andris9/php-sdk/blame/master/src/xml2array.php">Blame</a>
      <a rel="nofollow" class="btn btn-sm BtnGroup-item" href="/andris9/php-sdk/commits/master/src/xml2array.php">History</a>
    </div>

        <a class="btn-octicon tooltipped tooltipped-nw"
           href="https://desktop.github.com"
           aria-label="Open this file in GitHub Desktop"
           data-ga-click="Repository, open with desktop, type:windows">
            <svg class="octicon octicon-device-desktop" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M15 2H1c-.55 0-1 .45-1 1v9c0 .55.45 1 1 1h5.34c-.25.61-.86 1.39-2.34 2h8c-1.48-.61-2.09-1.39-2.34-2H15c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm0 9H1V3h14v8z"/></svg>
        </a>

          <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="inline-form js-update-url-with-hash" action="/andris9/php-sdk/edit/master/src/xml2array.php" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="ZcEqPwHTpeG1Qxq0jCArNqd3T/kOSOKudFGLTB3GoXOP0oT1lPgO6bEHarf4BCU7zHpI3NzVjU6b/qdIl70F5Q==" />
            <button class="btn-octicon tooltipped tooltipped-nw" type="submit"
              aria-label="Fork this project and edit the file" data-hotkey="e" data-disable-with>
              <svg class="octicon octicon-pencil" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M0 12v3h3l8-8-3-3-8 8zm3 2H1v-2h1v1h1v1zm10.3-9.3L12 6 9 3l1.3-1.3a.996.996 0 0 1 1.41 0l1.59 1.59c.39.39.39 1.02 0 1.41z"/></svg>
            </button>
</form>
        <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="inline-form" action="/andris9/php-sdk/delete/master/src/xml2array.php" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="m7i/gHHay8cObg9jcCOBVYiCYwOURC17/F91Zv3JZNNEqkD5OjGdBbWGsLgJWhmbLlznQLX8j7JK9KaVgsnx3g==" />
          <button class="btn-octicon btn-octicon-danger tooltipped tooltipped-nw" type="submit"
            aria-label="Fork this project and delete the file" data-disable-with>
            <svg class="octicon octicon-trashcan" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M11 2H9c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1H2c-.55 0-1 .45-1 1v1c0 .55.45 1 1 1v9c0 .55.45 1 1 1h7c.55 0 1-.45 1-1V5c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm-1 12H3V5h1v8h1V5h1v8h1V5h1v8h1V5h1v9zm1-10H2V3h9v1z"/></svg>
          </button>
</form>  </div>

  <div class="file-info">
      217 lines (176 sloc)
      <span class="file-info-divider"></span>
    6.89 KB
  </div>
</div>

    

  <div itemprop="text" class="blob-wrapper data type-php">
      <table class="highlight tab-size js-file-line-container" data-tab-size="8">
      <tr>
        <td id="L1" class="blob-num js-line-number" data-line-number="1"></td>
        <td id="LC1" class="blob-code blob-code-inner js-file-line"><span class="pl-pse">&lt;?php</span><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L2" class="blob-num js-line-number" data-line-number="2"></td>
        <td id="LC2" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L3" class="blob-num js-line-number" data-line-number="3"></td>
        <td id="LC3" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"><span class="pl-c">/*</span></span></span></td>
      </tr>
      <tr>
        <td id="L4" class="blob-num js-line-number" data-line-number="4"></td>
        <td id="LC4" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> * xmlToArrayParser code from http://www.php.net/manual/en/ref.xml.php by &quot;Glen at ITIstudios dot ca&quot;</span></span></td>
      </tr>
      <tr>
        <td id="L5" class="blob-num js-line-number" data-line-number="5"></td>
        <td id="LC5" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> *</span></span></td>
      </tr>
      <tr>
        <td id="L6" class="blob-num js-line-number" data-line-number="6"></td>
        <td id="LC6" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> * Code from PHP.net comments is licensed under Creative Commons Attribution 3.0 Unported (CC BY 3.0)</span></span></td>
      </tr>
      <tr>
        <td id="L7" class="blob-num js-line-number" data-line-number="7"></td>
        <td id="LC7" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> * http://creativecommons.org/licenses/by/3.0/legalcode</span></span></td>
      </tr>
      <tr>
        <td id="L8" class="blob-num js-line-number" data-line-number="8"></td>
        <td id="LC8" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> *</span></span></td>
      </tr>
      <tr>
        <td id="L9" class="blob-num js-line-number" data-line-number="9"></td>
        <td id="LC9" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> * More information - http://www.php.net/license/index.php#doc-lic</span></span></td>
      </tr>
      <tr>
        <td id="L10" class="blob-num js-line-number" data-line-number="10"></td>
        <td id="LC10" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> *</span></span></td>
      </tr>
      <tr>
        <td id="L11" class="blob-num js-line-number" data-line-number="11"></td>
        <td id="LC11" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> <span class="pl-c">*/</span></span></span></td>
      </tr>
      <tr>
        <td id="L12" class="blob-num js-line-number" data-line-number="12"></td>
        <td id="LC12" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L13" class="blob-num js-line-number" data-line-number="13"></td>
        <td id="LC13" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"><span class="pl-c">/**</span></span></span></td>
      </tr>
      <tr>
        <td id="L14" class="blob-num js-line-number" data-line-number="14"></td>
        <td id="LC14" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> * Convert an xml file to an associative array (including the tag attributes):</span></span></td>
      </tr>
      <tr>
        <td id="L15" class="blob-num js-line-number" data-line-number="15"></td>
        <td id="LC15" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> *</span></span></td>
      </tr>
      <tr>
        <td id="L16" class="blob-num js-line-number" data-line-number="16"></td>
        <td id="LC16" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> * <span class="pl-k">@param</span> Str $xml file/string.</span></span></td>
      </tr>
      <tr>
        <td id="L17" class="blob-num js-line-number" data-line-number="17"></td>
        <td id="LC17" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c"> <span class="pl-c">*/</span></span></span></td>
      </tr>
      <tr>
        <td id="L18" class="blob-num js-line-number" data-line-number="18"></td>
        <td id="LC18" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-k">class</span> <span class="pl-en">xmlToArrayParser</span> {</span></td>
      </tr>
      <tr>
        <td id="L19" class="blob-num js-line-number" data-line-number="19"></td>
        <td id="LC19" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-c"><span class="pl-c">/**</span></span></span></td>
      </tr>
      <tr>
        <td id="L20" class="blob-num js-line-number" data-line-number="20"></td>
        <td id="LC20" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     * The array created by the parser which can be assigned to a variable with: $varArr = $domObj-&gt;array.</span></span></td>
      </tr>
      <tr>
        <td id="L21" class="blob-num js-line-number" data-line-number="21"></td>
        <td id="LC21" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     *</span></span></td>
      </tr>
      <tr>
        <td id="L22" class="blob-num js-line-number" data-line-number="22"></td>
        <td id="LC22" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     * <span class="pl-k">@var</span> Array</span></span></td>
      </tr>
      <tr>
        <td id="L23" class="blob-num js-line-number" data-line-number="23"></td>
        <td id="LC23" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     <span class="pl-c">*/</span></span></span></td>
      </tr>
      <tr>
        <td id="L24" class="blob-num js-line-number" data-line-number="24"></td>
        <td id="LC24" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">public</span>    <span class="pl-smi">$array</span>;</span></td>
      </tr>
      <tr>
        <td id="L25" class="blob-num js-line-number" data-line-number="25"></td>
        <td id="LC25" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">protected</span> <span class="pl-smi">$parser</span>;</span></td>
      </tr>
      <tr>
        <td id="L26" class="blob-num js-line-number" data-line-number="26"></td>
        <td id="LC26" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">protected</span> <span class="pl-smi">$pointer</span>;</span></td>
      </tr>
      <tr>
        <td id="L27" class="blob-num js-line-number" data-line-number="27"></td>
        <td id="LC27" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L28" class="blob-num js-line-number" data-line-number="28"></td>
        <td id="LC28" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-c"><span class="pl-c">/**</span></span></span></td>
      </tr>
      <tr>
        <td id="L29" class="blob-num js-line-number" data-line-number="29"></td>
        <td id="LC29" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     * $domObj = new xmlToArrayParser($xml);</span></span></td>
      </tr>
      <tr>
        <td id="L30" class="blob-num js-line-number" data-line-number="30"></td>
        <td id="LC30" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     *</span></span></td>
      </tr>
      <tr>
        <td id="L31" class="blob-num js-line-number" data-line-number="31"></td>
        <td id="LC31" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     * <span class="pl-k">@param</span> Str $xml file/string</span></span></td>
      </tr>
      <tr>
        <td id="L32" class="blob-num js-line-number" data-line-number="32"></td>
        <td id="LC32" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     <span class="pl-c">*/</span></span></span></td>
      </tr>
      <tr>
        <td id="L33" class="blob-num js-line-number" data-line-number="33"></td>
        <td id="LC33" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-c1">__construct</span>(<span class="pl-smi">$xml</span>) {</span></td>
      </tr>
      <tr>
        <td id="L34" class="blob-num js-line-number" data-line-number="34"></td>
        <td id="LC34" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span> <span class="pl-k">=</span><span class="pl-k">&amp;</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">array</span>;</span></td>
      </tr>
      <tr>
        <td id="L35" class="blob-num js-line-number" data-line-number="35"></td>
        <td id="LC35" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">parser</span> <span class="pl-k">=</span> <span class="pl-c1">xml_parser_create</span>(<span class="pl-s"><span class="pl-pds">&quot;</span>UTF-8<span class="pl-pds">&quot;</span></span>);</span></td>
      </tr>
      <tr>
        <td id="L36" class="blob-num js-line-number" data-line-number="36"></td>
        <td id="LC36" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-c1">xml_set_object</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">parser</span>, <span class="pl-smi">$this</span>);</span></td>
      </tr>
      <tr>
        <td id="L37" class="blob-num js-line-number" data-line-number="37"></td>
        <td id="LC37" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-c1">xml_parser_set_option</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">parser</span>, <span class="pl-c1">XML_OPTION_CASE_FOLDING</span>, <span class="pl-c1">false</span>);</span></td>
      </tr>
      <tr>
        <td id="L38" class="blob-num js-line-number" data-line-number="38"></td>
        <td id="LC38" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-c1">xml_set_element_handler</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">parser</span>, <span class="pl-s"><span class="pl-pds">&quot;</span>tag_open<span class="pl-pds">&quot;</span></span>, <span class="pl-s"><span class="pl-pds">&quot;</span>tag_close<span class="pl-pds">&quot;</span></span>);</span></td>
      </tr>
      <tr>
        <td id="L39" class="blob-num js-line-number" data-line-number="39"></td>
        <td id="LC39" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-c1">xml_set_character_data_handler</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">parser</span>, <span class="pl-s"><span class="pl-pds">&quot;</span>cdata<span class="pl-pds">&quot;</span></span>);</span></td>
      </tr>
      <tr>
        <td id="L40" class="blob-num js-line-number" data-line-number="40"></td>
        <td id="LC40" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-c1">xml_parse</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">parser</span>, <span class="pl-c1">ltrim</span>(<span class="pl-smi">$xml</span>));</span></td>
      </tr>
      <tr>
        <td id="L41" class="blob-num js-line-number" data-line-number="41"></td>
        <td id="LC41" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    }</span></td>
      </tr>
      <tr>
        <td id="L42" class="blob-num js-line-number" data-line-number="42"></td>
        <td id="LC42" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    </span></td>
      </tr>
      <tr>
        <td id="L43" class="blob-num js-line-number" data-line-number="43"></td>
        <td id="LC43" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">setServiceXML</span>(<span class="pl-smi">$filename</span>, <span class="pl-smi">$onlyApproved</span> <span class="pl-k">=</span> <span class="pl-c1">true</span>){</span></td>
      </tr>
      <tr>
        <td id="L44" class="blob-num js-line-number" data-line-number="44"></td>
        <td id="LC44" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span>setServiceXMLString(<span class="pl-c1">file_get_contents</span>(<span class="pl-smi">$filename</span>), <span class="pl-smi">$onlyApproved</span>);</span></td>
      </tr>
      <tr>
        <td id="L45" class="blob-num js-line-number" data-line-number="45"></td>
        <td id="LC45" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    }</span></td>
      </tr>
      <tr>
        <td id="L46" class="blob-num js-line-number" data-line-number="46"></td>
        <td id="LC46" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L47" class="blob-num js-line-number" data-line-number="47"></td>
        <td id="LC47" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">setServiceXMLString</span>(<span class="pl-smi">$xml</span>, <span class="pl-smi">$onlyApproved</span> <span class="pl-k">=</span> <span class="pl-c1">true</span>){</span></td>
      </tr>
      <tr>
        <td id="L48" class="blob-num js-line-number" data-line-number="48"></td>
        <td id="LC48" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$domObj</span> <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-c1">xmlToArrayParser</span>(<span class="pl-smi">$xml</span>);</span></td>
      </tr>
      <tr>
        <td id="L49" class="blob-num js-line-number" data-line-number="49"></td>
        <td id="LC49" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$domArr</span> <span class="pl-k">=</span> <span class="pl-smi">$domObj</span><span class="pl-k">-&gt;</span><span class="pl-smi">array</span>;</span></td>
      </tr>
      <tr>
        <td id="L50" class="blob-num js-line-number" data-line-number="50"></td>
        <td id="LC50" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>();</span></td>
      </tr>
      <tr>
        <td id="L51" class="blob-num js-line-number" data-line-number="51"></td>
        <td id="LC51" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L52" class="blob-num js-line-number" data-line-number="52"></td>
        <td id="LC52" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-k">!</span><span class="pl-smi">$domArr</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>services_api_response<span class="pl-pds">&quot;</span></span>]){</span></td>
      </tr>
      <tr>
        <td id="L53" class="blob-num js-line-number" data-line-number="53"></td>
        <td id="LC53" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">lastError</span> <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">&quot;</span>Invalid XML<span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L54" class="blob-num js-line-number" data-line-number="54"></td>
        <td id="LC54" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-k">return</span>;</span></td>
      </tr>
      <tr>
        <td id="L55" class="blob-num js-line-number" data-line-number="55"></td>
        <td id="LC55" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L56" class="blob-num js-line-number" data-line-number="56"></td>
        <td id="LC56" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L57" class="blob-num js-line-number" data-line-number="57"></td>
        <td id="LC57" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-smi">$domArr</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>services_api_response<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>status<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>code<span class="pl-pds">&quot;</span></span>] <span class="pl-k">!</span><span class="pl-k">==</span> <span class="pl-s"><span class="pl-pds">&quot;</span>0<span class="pl-pds">&quot;</span></span>){</span></td>
      </tr>
      <tr>
        <td id="L58" class="blob-num js-line-number" data-line-number="58"></td>
        <td id="LC58" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">lastError</span> <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">&quot;</span>Invalid status code<span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L59" class="blob-num js-line-number" data-line-number="59"></td>
        <td id="LC59" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-k">return</span>;</span></td>
      </tr>
      <tr>
        <td id="L60" class="blob-num js-line-number" data-line-number="60"></td>
        <td id="LC60" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L61" class="blob-num js-line-number" data-line-number="61"></td>
        <td id="LC61" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L62" class="blob-num js-line-number" data-line-number="62"></td>
        <td id="LC62" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceId</span> <span class="pl-k">&amp;&amp;</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceId</span> <span class="pl-k">!</span><span class="pl-k">=</span> <span class="pl-smi">$domArr</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>services_api_response<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>service<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>id<span class="pl-pds">&quot;</span></span>]){</span></td>
      </tr>
      <tr>
        <td id="L63" class="blob-num js-line-number" data-line-number="63"></td>
        <td id="LC63" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">lastError</span> <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">&quot;</span>Invalid service code in XML<span class="pl-pds">&quot;</span></span>;</span></td>
      </tr>
      <tr>
        <td id="L64" class="blob-num js-line-number" data-line-number="64"></td>
        <td id="LC64" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-k">return</span>;</span></td>
      </tr>
      <tr>
        <td id="L65" class="blob-num js-line-number" data-line-number="65"></td>
        <td id="LC65" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L66" class="blob-num js-line-number" data-line-number="66"></td>
        <td id="LC66" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L67" class="blob-num js-line-number" data-line-number="67"></td>
        <td id="LC67" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$countryList</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>();</span></td>
      </tr>
      <tr>
        <td id="L68" class="blob-num js-line-number" data-line-number="68"></td>
        <td id="LC68" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">foreach</span>(<span class="pl-smi">$domArr</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>services_api_response<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>service<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>countries<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>country<span class="pl-pds">&quot;</span></span>] <span class="pl-k">as</span> <span class="pl-smi">$country</span>){</span></td>
      </tr>
      <tr>
        <td id="L69" class="blob-num js-line-number" data-line-number="69"></td>
        <td id="LC69" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-k">if</span>(<span class="pl-k">!</span><span class="pl-smi">$country</span> <span class="pl-k">||</span> (<span class="pl-smi">$onlyApproved</span> <span class="pl-k">&amp;&amp;</span> <span class="pl-smi">$country</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>approved<span class="pl-pds">&quot;</span></span>] <span class="pl-k">!</span><span class="pl-k">==</span> <span class="pl-s"><span class="pl-pds">&quot;</span>true<span class="pl-pds">&quot;</span></span>))<span class="pl-k">continue</span>;</span></td>
      </tr>
      <tr>
        <td id="L70" class="blob-num js-line-number" data-line-number="70"></td>
        <td id="LC70" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$countryList</span>[<span class="pl-smi">$country</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>code<span class="pl-pds">&quot;</span></span>]] <span class="pl-k">=</span> <span class="pl-smi">$country</span>;</span></td>
      </tr>
      <tr>
        <td id="L71" class="blob-num js-line-number" data-line-number="71"></td>
        <td id="LC71" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        };</span></td>
      </tr>
      <tr>
        <td id="L72" class="blob-num js-line-number" data-line-number="72"></td>
        <td id="LC72" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L73" class="blob-num js-line-number" data-line-number="73"></td>
        <td id="LC73" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span> <span class="pl-k">=</span> <span class="pl-smi">$countryList</span>;</span></td>
      </tr>
      <tr>
        <td id="L74" class="blob-num js-line-number" data-line-number="74"></td>
        <td id="LC74" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    }</span></td>
      </tr>
      <tr>
        <td id="L75" class="blob-num js-line-number" data-line-number="75"></td>
        <td id="LC75" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L76" class="blob-num js-line-number" data-line-number="76"></td>
        <td id="LC76" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">getAvailableCountries</span>(){</span></td>
      </tr>
      <tr>
        <td id="L77" class="blob-num js-line-number" data-line-number="77"></td>
        <td id="LC77" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L78" class="blob-num js-line-number" data-line-number="78"></td>
        <td id="LC78" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$countryList</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>();</span></td>
      </tr>
      <tr>
        <td id="L79" class="blob-num js-line-number" data-line-number="79"></td>
        <td id="LC79" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">foreach</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span> <span class="pl-k">as</span> <span class="pl-smi">$code</span> <span class="pl-k">=&gt;</span> <span class="pl-smi">$country</span>){</span></td>
      </tr>
      <tr>
        <td id="L80" class="blob-num js-line-number" data-line-number="80"></td>
        <td id="LC80" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$countryList</span>[<span class="pl-smi">$code</span>] <span class="pl-k">=</span> <span class="pl-smi">$country</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>name<span class="pl-pds">&quot;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L81" class="blob-num js-line-number" data-line-number="81"></td>
        <td id="LC81" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L82" class="blob-num js-line-number" data-line-number="82"></td>
        <td id="LC82" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L83" class="blob-num js-line-number" data-line-number="83"></td>
        <td id="LC83" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-c1">asort</span>(<span class="pl-smi">$countryList</span>);</span></td>
      </tr>
      <tr>
        <td id="L84" class="blob-num js-line-number" data-line-number="84"></td>
        <td id="LC84" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L85" class="blob-num js-line-number" data-line-number="85"></td>
        <td id="LC85" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">return</span> <span class="pl-smi">$countryList</span>;</span></td>
      </tr>
      <tr>
        <td id="L86" class="blob-num js-line-number" data-line-number="86"></td>
        <td id="LC86" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    }</span></td>
      </tr>
      <tr>
        <td id="L87" class="blob-num js-line-number" data-line-number="87"></td>
        <td id="LC87" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L88" class="blob-num js-line-number" data-line-number="88"></td>
        <td id="LC88" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">public</span> <span class="pl-k">function</span> <span class="pl-en">getCountryInformation</span>(<span class="pl-smi">$country</span> <span class="pl-k">=</span> <span class="pl-c1">false</span>){</span></td>
      </tr>
      <tr>
        <td id="L89" class="blob-num js-line-number" data-line-number="89"></td>
        <td id="LC89" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-k">!</span><span class="pl-smi">$country</span>){</span></td>
      </tr>
      <tr>
        <td id="L90" class="blob-num js-line-number" data-line-number="90"></td>
        <td id="LC90" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$keys</span> <span class="pl-k">=</span> <span class="pl-c1">array_keys</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>);</span></td>
      </tr>
      <tr>
        <td id="L91" class="blob-num js-line-number" data-line-number="91"></td>
        <td id="LC91" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$country</span> <span class="pl-k">=</span> <span class="pl-c1">count</span>(<span class="pl-smi">$keys</span>) ? <span class="pl-smi">$keys</span>[<span class="pl-c1">0</span>] : <span class="pl-c1">false</span>;</span></td>
      </tr>
      <tr>
        <td id="L92" class="blob-num js-line-number" data-line-number="92"></td>
        <td id="LC92" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L93" class="blob-num js-line-number" data-line-number="93"></td>
        <td id="LC93" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L94" class="blob-num js-line-number" data-line-number="94"></td>
        <td id="LC94" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-k">!</span><span class="pl-smi">$country</span> <span class="pl-k">||</span> <span class="pl-k">!</span><span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>[<span class="pl-smi">$country</span>]){</span></td>
      </tr>
      <tr>
        <td id="L95" class="blob-num js-line-number" data-line-number="95"></td>
        <td id="LC95" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-k">return</span> <span class="pl-c1">false</span>;</span></td>
      </tr>
      <tr>
        <td id="L96" class="blob-num js-line-number" data-line-number="96"></td>
        <td id="LC96" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L97" class="blob-num js-line-number" data-line-number="97"></td>
        <td id="LC97" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L98" class="blob-num js-line-number" data-line-number="98"></td>
        <td id="LC98" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$countryInformation</span> <span class="pl-k">=</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>[<span class="pl-smi">$country</span>][<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L99" class="blob-num js-line-number" data-line-number="99"></td>
        <td id="LC99" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L100" class="blob-num js-line-number" data-line-number="100"></td>
        <td id="LC100" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-c"><span class="pl-c">//</span> same settings for all operators</span></span></td>
      </tr>
      <tr>
        <td id="L101" class="blob-num js-line-number" data-line-number="101"></td>
        <td id="LC101" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>[<span class="pl-smi">$country</span>][<span class="pl-s"><span class="pl-pds">&quot;</span>prices<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>price<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>all_operators<span class="pl-pds">&quot;</span></span>] <span class="pl-k">===</span> <span class="pl-s"><span class="pl-pds">&quot;</span>true<span class="pl-pds">&quot;</span></span>){</span></td>
      </tr>
      <tr>
        <td id="L102" class="blob-num js-line-number" data-line-number="102"></td>
        <td id="LC102" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$countryInformation</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>all_operators<span class="pl-pds">&quot;</span></span>] <span class="pl-k">=</span> <span class="pl-c1">array_merge</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>[<span class="pl-smi">$country</span>][<span class="pl-s"><span class="pl-pds">&quot;</span>prices<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>price<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>],</span></td>
      </tr>
      <tr>
        <td id="L103" class="blob-num js-line-number" data-line-number="103"></td>
        <td id="LC103" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>[<span class="pl-smi">$country</span>][<span class="pl-s"><span class="pl-pds">&quot;</span>prices<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>price<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>message_profile<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L104" class="blob-num js-line-number" data-line-number="104"></td>
        <td id="LC104" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-c1">unset</span>(<span class="pl-smi">$countryInformation</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>all_operators<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>all_operators<span class="pl-pds">&quot;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L105" class="blob-num js-line-number" data-line-number="105"></td>
        <td id="LC105" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }<span class="pl-k">else</span>{</span></td>
      </tr>
      <tr>
        <td id="L106" class="blob-num js-line-number" data-line-number="106"></td>
        <td id="LC106" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$countryInformation</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>all_operators<span class="pl-pds">&quot;</span></span>] <span class="pl-k">=</span> <span class="pl-c1">false</span>;</span></td>
      </tr>
      <tr>
        <td id="L107" class="blob-num js-line-number" data-line-number="107"></td>
        <td id="LC107" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L108" class="blob-num js-line-number" data-line-number="108"></td>
        <td id="LC108" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L109" class="blob-num js-line-number" data-line-number="109"></td>
        <td id="LC109" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>[<span class="pl-smi">$country</span>][<span class="pl-s"><span class="pl-pds">&quot;</span>prices<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>price<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>]){</span></td>
      </tr>
      <tr>
        <td id="L110" class="blob-num js-line-number" data-line-number="110"></td>
        <td id="LC110" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$priceData</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>[<span class="pl-smi">$country</span>][<span class="pl-s"><span class="pl-pds">&quot;</span>prices<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>price<span class="pl-pds">&quot;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L111" class="blob-num js-line-number" data-line-number="111"></td>
        <td id="LC111" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }<span class="pl-k">else</span>{</span></td>
      </tr>
      <tr>
        <td id="L112" class="blob-num js-line-number" data-line-number="112"></td>
        <td id="LC112" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$priceData</span> <span class="pl-k">=</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>[<span class="pl-smi">$country</span>][<span class="pl-s"><span class="pl-pds">&quot;</span>prices<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>price<span class="pl-pds">&quot;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L113" class="blob-num js-line-number" data-line-number="113"></td>
        <td id="LC113" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L114" class="blob-num js-line-number" data-line-number="114"></td>
        <td id="LC114" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L115" class="blob-num js-line-number" data-line-number="115"></td>
        <td id="LC115" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L116" class="blob-num js-line-number" data-line-number="116"></td>
        <td id="LC116" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L117" class="blob-num js-line-number" data-line-number="117"></td>
        <td id="LC117" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$operators</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>();</span></td>
      </tr>
      <tr>
        <td id="L118" class="blob-num js-line-number" data-line-number="118"></td>
        <td id="LC118" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L119" class="blob-num js-line-number" data-line-number="119"></td>
        <td id="LC119" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-smi">$priceData</span>){</span></td>
      </tr>
      <tr>
        <td id="L120" class="blob-num js-line-number" data-line-number="120"></td>
        <td id="LC120" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-k">foreach</span>(<span class="pl-smi">$priceData</span> <span class="pl-k">as</span> <span class="pl-smi">$price</span>){</span></td>
      </tr>
      <tr>
        <td id="L121" class="blob-num js-line-number" data-line-number="121"></td>
        <td id="LC121" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L122" class="blob-num js-line-number" data-line-number="122"></td>
        <td id="LC122" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                <span class="pl-smi">$keywordData</span> <span class="pl-k">=</span> <span class="pl-smi">$price</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L123" class="blob-num js-line-number" data-line-number="123"></td>
        <td id="LC123" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L124" class="blob-num js-line-number" data-line-number="124"></td>
        <td id="LC124" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                <span class="pl-k">if</span>(<span class="pl-smi">$price</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>message_profile<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>operator<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>]){</span></td>
      </tr>
      <tr>
        <td id="L125" class="blob-num js-line-number" data-line-number="125"></td>
        <td id="LC125" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                    <span class="pl-smi">$operatorArray</span> <span class="pl-k">=</span> <span class="pl-c1">array</span>(<span class="pl-smi">$price</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>message_profile<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>operator<span class="pl-pds">&quot;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L126" class="blob-num js-line-number" data-line-number="126"></td>
        <td id="LC126" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                }<span class="pl-k">else</span>{</span></td>
      </tr>
      <tr>
        <td id="L127" class="blob-num js-line-number" data-line-number="127"></td>
        <td id="LC127" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                    <span class="pl-smi">$operatorArray</span> <span class="pl-k">=</span> <span class="pl-smi">$price</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>message_profile<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>operator<span class="pl-pds">&quot;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L128" class="blob-num js-line-number" data-line-number="128"></td>
        <td id="LC128" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                }</span></td>
      </tr>
      <tr>
        <td id="L129" class="blob-num js-line-number" data-line-number="129"></td>
        <td id="LC129" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L130" class="blob-num js-line-number" data-line-number="130"></td>
        <td id="LC130" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                <span class="pl-k">if</span>(<span class="pl-smi">$operatorArray</span>){</span></td>
      </tr>
      <tr>
        <td id="L131" class="blob-num js-line-number" data-line-number="131"></td>
        <td id="LC131" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                    <span class="pl-k">foreach</span>(<span class="pl-smi">$operatorArray</span> <span class="pl-k">as</span> <span class="pl-smi">$operator</span>){</span></td>
      </tr>
      <tr>
        <td id="L132" class="blob-num js-line-number" data-line-number="132"></td>
        <td id="LC132" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                        <span class="pl-smi">$operator</span> <span class="pl-k">=</span> <span class="pl-c1">array_merge</span>(<span class="pl-smi">$keywordData</span>, <span class="pl-smi">$price</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>message_profile<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>], <span class="pl-smi">$operator</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>_<span class="pl-pds">&quot;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L133" class="blob-num js-line-number" data-line-number="133"></td>
        <td id="LC133" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                        <span class="pl-c1">unset</span>(<span class="pl-smi">$operator</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>all_operators<span class="pl-pds">&quot;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L134" class="blob-num js-line-number" data-line-number="134"></td>
        <td id="LC134" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                        <span class="pl-smi">$operators</span>[] <span class="pl-k">=</span> <span class="pl-smi">$operator</span>;</span></td>
      </tr>
      <tr>
        <td id="L135" class="blob-num js-line-number" data-line-number="135"></td>
        <td id="LC135" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                    }</span></td>
      </tr>
      <tr>
        <td id="L136" class="blob-num js-line-number" data-line-number="136"></td>
        <td id="LC136" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                }</span></td>
      </tr>
      <tr>
        <td id="L137" class="blob-num js-line-number" data-line-number="137"></td>
        <td id="LC137" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            }</span></td>
      </tr>
      <tr>
        <td id="L138" class="blob-num js-line-number" data-line-number="138"></td>
        <td id="LC138" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L139" class="blob-num js-line-number" data-line-number="139"></td>
        <td id="LC139" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L140" class="blob-num js-line-number" data-line-number="140"></td>
        <td id="LC140" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$countryInformation</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>operators<span class="pl-pds">&quot;</span></span>] <span class="pl-k">=</span> <span class="pl-smi">$operators</span>;</span></td>
      </tr>
      <tr>
        <td id="L141" class="blob-num js-line-number" data-line-number="141"></td>
        <td id="LC141" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L142" class="blob-num js-line-number" data-line-number="142"></td>
        <td id="LC142" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$countryInformation</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>promotional_text<span class="pl-pds">&quot;</span></span>] <span class="pl-k">=</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">serviceData</span>[<span class="pl-smi">$country</span>][<span class="pl-s"><span class="pl-pds">&quot;</span>promotional_text<span class="pl-pds">&quot;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L143" class="blob-num js-line-number" data-line-number="143"></td>
        <td id="LC143" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-c1">unset</span>(<span class="pl-smi">$countryInformation</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>promotional_text<span class="pl-pds">&quot;</span></span>][<span class="pl-s"><span class="pl-pds">&quot;</span>cdata<span class="pl-pds">&quot;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L144" class="blob-num js-line-number" data-line-number="144"></td>
        <td id="LC144" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L145" class="blob-num js-line-number" data-line-number="145"></td>
        <td id="LC145" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">return</span> <span class="pl-smi">$countryInformation</span>;</span></td>
      </tr>
      <tr>
        <td id="L146" class="blob-num js-line-number" data-line-number="146"></td>
        <td id="LC146" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    }</span></td>
      </tr>
      <tr>
        <td id="L147" class="blob-num js-line-number" data-line-number="147"></td>
        <td id="LC147" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L148" class="blob-num js-line-number" data-line-number="148"></td>
        <td id="LC148" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">protected</span> <span class="pl-k">function</span> <span class="pl-en">tag_open</span>(<span class="pl-smi">$parser</span>, <span class="pl-smi">$tag</span>, <span class="pl-smi">$attributes</span>) {</span></td>
      </tr>
      <tr>
        <td id="L149" class="blob-num js-line-number" data-line-number="149"></td>
        <td id="LC149" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span>convert_to_array(<span class="pl-smi">$tag</span>, <span class="pl-s"><span class="pl-pds">&#39;</span>_<span class="pl-pds">&#39;</span></span>);</span></td>
      </tr>
      <tr>
        <td id="L150" class="blob-num js-line-number" data-line-number="150"></td>
        <td id="LC150" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$idx</span><span class="pl-k">=</span><span class="pl-smi">$this</span><span class="pl-k">-&gt;</span>convert_to_array(<span class="pl-smi">$tag</span>, <span class="pl-s"><span class="pl-pds">&#39;</span>cdata<span class="pl-pds">&#39;</span></span>);</span></td>
      </tr>
      <tr>
        <td id="L151" class="blob-num js-line-number" data-line-number="151"></td>
        <td id="LC151" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L152" class="blob-num js-line-number" data-line-number="152"></td>
        <td id="LC152" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-c1">isset</span>(<span class="pl-smi">$idx</span>)){</span></td>
      </tr>
      <tr>
        <td id="L153" class="blob-num js-line-number" data-line-number="153"></td>
        <td id="LC153" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>][<span class="pl-smi">$idx</span>] <span class="pl-k">=</span> <span class="pl-k">Array</span>(<span class="pl-s"><span class="pl-pds">&#39;</span>@idx<span class="pl-pds">&#39;</span></span> <span class="pl-k">=&gt;</span> <span class="pl-smi">$idx</span>,<span class="pl-s"><span class="pl-pds">&#39;</span>@parent<span class="pl-pds">&#39;</span></span> <span class="pl-k">=&gt;</span> <span class="pl-k">&amp;</span><span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>);</span></td>
      </tr>
      <tr>
        <td id="L154" class="blob-num js-line-number" data-line-number="154"></td>
        <td id="LC154" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span> <span class="pl-k">=</span><span class="pl-k">&amp;</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>][<span class="pl-smi">$idx</span>];</span></td>
      </tr>
      <tr>
        <td id="L155" class="blob-num js-line-number" data-line-number="155"></td>
        <td id="LC155" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }<span class="pl-k">else</span>{</span></td>
      </tr>
      <tr>
        <td id="L156" class="blob-num js-line-number" data-line-number="156"></td>
        <td id="LC156" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>] <span class="pl-k">=</span> <span class="pl-k">Array</span>(<span class="pl-s"><span class="pl-pds">&#39;</span>@parent<span class="pl-pds">&#39;</span></span> <span class="pl-k">=&gt;</span> <span class="pl-k">&amp;</span><span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>);</span></td>
      </tr>
      <tr>
        <td id="L157" class="blob-num js-line-number" data-line-number="157"></td>
        <td id="LC157" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span> <span class="pl-k">=</span><span class="pl-k">&amp;</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>];</span></td>
      </tr>
      <tr>
        <td id="L158" class="blob-num js-line-number" data-line-number="158"></td>
        <td id="LC158" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L159" class="blob-num js-line-number" data-line-number="159"></td>
        <td id="LC159" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L160" class="blob-num js-line-number" data-line-number="160"></td>
        <td id="LC160" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-k">!</span><span class="pl-c1">empty</span>(<span class="pl-smi">$attributes</span>)){</span></td>
      </tr>
      <tr>
        <td id="L161" class="blob-num js-line-number" data-line-number="161"></td>
        <td id="LC161" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>_<span class="pl-pds">&#39;</span></span>] <span class="pl-k">=</span> <span class="pl-smi">$attributes</span>;</span></td>
      </tr>
      <tr>
        <td id="L162" class="blob-num js-line-number" data-line-number="162"></td>
        <td id="LC162" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L163" class="blob-num js-line-number" data-line-number="163"></td>
        <td id="LC163" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    }</span></td>
      </tr>
      <tr>
        <td id="L164" class="blob-num js-line-number" data-line-number="164"></td>
        <td id="LC164" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L165" class="blob-num js-line-number" data-line-number="165"></td>
        <td id="LC165" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-c"><span class="pl-c">/**</span></span></span></td>
      </tr>
      <tr>
        <td id="L166" class="blob-num js-line-number" data-line-number="166"></td>
        <td id="LC166" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     * Adds the current elements content to the current pointer[cdata] array.</span></span></td>
      </tr>
      <tr>
        <td id="L167" class="blob-num js-line-number" data-line-number="167"></td>
        <td id="LC167" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     <span class="pl-c">*/</span></span></span></td>
      </tr>
      <tr>
        <td id="L168" class="blob-num js-line-number" data-line-number="168"></td>
        <td id="LC168" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">protected</span> <span class="pl-k">function</span> <span class="pl-en">cdata</span>(<span class="pl-smi">$parser</span>, <span class="pl-smi">$cdata</span>) {</span></td>
      </tr>
      <tr>
        <td id="L169" class="blob-num js-line-number" data-line-number="169"></td>
        <td id="LC169" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-c1">isset</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>cdata<span class="pl-pds">&#39;</span></span>])){</span></td>
      </tr>
      <tr>
        <td id="L170" class="blob-num js-line-number" data-line-number="170"></td>
        <td id="LC170" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>cdata<span class="pl-pds">&#39;</span></span>] <span class="pl-k">.=</span> <span class="pl-smi">$cdata</span>;</span></td>
      </tr>
      <tr>
        <td id="L171" class="blob-num js-line-number" data-line-number="171"></td>
        <td id="LC171" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }<span class="pl-k">else</span>{</span></td>
      </tr>
      <tr>
        <td id="L172" class="blob-num js-line-number" data-line-number="172"></td>
        <td id="LC172" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>cdata<span class="pl-pds">&#39;</span></span>] <span class="pl-k">=</span> <span class="pl-smi">$cdata</span>;</span></td>
      </tr>
      <tr>
        <td id="L173" class="blob-num js-line-number" data-line-number="173"></td>
        <td id="LC173" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L174" class="blob-num js-line-number" data-line-number="174"></td>
        <td id="LC174" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    }</span></td>
      </tr>
      <tr>
        <td id="L175" class="blob-num js-line-number" data-line-number="175"></td>
        <td id="LC175" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L176" class="blob-num js-line-number" data-line-number="176"></td>
        <td id="LC176" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">protected</span> <span class="pl-k">function</span> <span class="pl-en">tag_close</span>(<span class="pl-smi">$parser</span>, <span class="pl-smi">$tag</span>) {</span></td>
      </tr>
      <tr>
        <td id="L177" class="blob-num js-line-number" data-line-number="177"></td>
        <td id="LC177" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$current</span> <span class="pl-k">=</span> <span class="pl-k">&amp;</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>;</span></td>
      </tr>
      <tr>
        <td id="L178" class="blob-num js-line-number" data-line-number="178"></td>
        <td id="LC178" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L179" class="blob-num js-line-number" data-line-number="179"></td>
        <td id="LC179" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-c1">isset</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>@idx<span class="pl-pds">&#39;</span></span>])){</span></td>
      </tr>
      <tr>
        <td id="L180" class="blob-num js-line-number" data-line-number="180"></td>
        <td id="LC180" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-c1">unset</span>(<span class="pl-smi">$current</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>@idx<span class="pl-pds">&#39;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L181" class="blob-num js-line-number" data-line-number="181"></td>
        <td id="LC181" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L182" class="blob-num js-line-number" data-line-number="182"></td>
        <td id="LC182" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L183" class="blob-num js-line-number" data-line-number="183"></td>
        <td id="LC183" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span> <span class="pl-k">=</span> <span class="pl-k">&amp;</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>@parent<span class="pl-pds">&#39;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L184" class="blob-num js-line-number" data-line-number="184"></td>
        <td id="LC184" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L185" class="blob-num js-line-number" data-line-number="185"></td>
        <td id="LC185" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-c1">unset</span>(<span class="pl-smi">$current</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>@parent<span class="pl-pds">&#39;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L186" class="blob-num js-line-number" data-line-number="186"></td>
        <td id="LC186" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L187" class="blob-num js-line-number" data-line-number="187"></td>
        <td id="LC187" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-c1">isset</span>(<span class="pl-smi">$current</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>cdata<span class="pl-pds">&#39;</span></span>]) <span class="pl-k">&amp;&amp;</span> <span class="pl-c1">count</span>(<span class="pl-smi">$current</span>) <span class="pl-k">==</span> <span class="pl-c1">1</span>){</span></td>
      </tr>
      <tr>
        <td id="L188" class="blob-num js-line-number" data-line-number="188"></td>
        <td id="LC188" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$current</span> <span class="pl-k">=</span> <span class="pl-smi">$current</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>cdata<span class="pl-pds">&#39;</span></span>];</span></td>
      </tr>
      <tr>
        <td id="L189" class="blob-num js-line-number" data-line-number="189"></td>
        <td id="LC189" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }<span class="pl-k">else</span> <span class="pl-k">if</span>(<span class="pl-c1">empty</span>(<span class="pl-smi">$current</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>cdata<span class="pl-pds">&#39;</span></span>])){</span></td>
      </tr>
      <tr>
        <td id="L190" class="blob-num js-line-number" data-line-number="190"></td>
        <td id="LC190" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-c1">unset</span>(<span class="pl-smi">$current</span>[<span class="pl-s"><span class="pl-pds">&#39;</span>cdata<span class="pl-pds">&#39;</span></span>]);</span></td>
      </tr>
      <tr>
        <td id="L191" class="blob-num js-line-number" data-line-number="191"></td>
        <td id="LC191" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L192" class="blob-num js-line-number" data-line-number="192"></td>
        <td id="LC192" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    }</span></td>
      </tr>
      <tr>
        <td id="L193" class="blob-num js-line-number" data-line-number="193"></td>
        <td id="LC193" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L194" class="blob-num js-line-number" data-line-number="194"></td>
        <td id="LC194" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-c"><span class="pl-c">/**</span></span></span></td>
      </tr>
      <tr>
        <td id="L195" class="blob-num js-line-number" data-line-number="195"></td>
        <td id="LC195" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     * Converts a single element item into array(element[0]) if a second element of the same name is encountered.</span></span></td>
      </tr>
      <tr>
        <td id="L196" class="blob-num js-line-number" data-line-number="196"></td>
        <td id="LC196" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"><span class="pl-c">     <span class="pl-c">*/</span></span></span></td>
      </tr>
      <tr>
        <td id="L197" class="blob-num js-line-number" data-line-number="197"></td>
        <td id="LC197" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    <span class="pl-k">protected</span> <span class="pl-k">function</span> <span class="pl-en">convert_to_array</span>(<span class="pl-smi">$tag</span>, <span class="pl-smi">$item</span>) {</span></td>
      </tr>
      <tr>
        <td id="L198" class="blob-num js-line-number" data-line-number="198"></td>
        <td id="LC198" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L199" class="blob-num js-line-number" data-line-number="199"></td>
        <td id="LC199" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">if</span>(<span class="pl-c1">isset</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>][<span class="pl-smi">$item</span>])) {</span></td>
      </tr>
      <tr>
        <td id="L200" class="blob-num js-line-number" data-line-number="200"></td>
        <td id="LC200" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$content</span> <span class="pl-k">=</span> <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>];</span></td>
      </tr>
      <tr>
        <td id="L201" class="blob-num js-line-number" data-line-number="201"></td>
        <td id="LC201" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>] <span class="pl-k">=</span> <span class="pl-c1">array</span>((<span class="pl-c1">0</span>) <span class="pl-k">=&gt;</span> <span class="pl-smi">$content</span>);</span></td>
      </tr>
      <tr>
        <td id="L202" class="blob-num js-line-number" data-line-number="202"></td>
        <td id="LC202" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$idx</span> <span class="pl-k">=</span> <span class="pl-c1">1</span>;</span></td>
      </tr>
      <tr>
        <td id="L203" class="blob-num js-line-number" data-line-number="203"></td>
        <td id="LC203" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }<span class="pl-k">else</span> <span class="pl-k">if</span> (<span class="pl-c1">isset</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>])) {</span></td>
      </tr>
      <tr>
        <td id="L204" class="blob-num js-line-number" data-line-number="204"></td>
        <td id="LC204" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$idx</span> <span class="pl-k">=</span> <span class="pl-c1">count</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>]);</span></td>
      </tr>
      <tr>
        <td id="L205" class="blob-num js-line-number" data-line-number="205"></td>
        <td id="LC205" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-k">if</span>(<span class="pl-k">!</span><span class="pl-c1">isset</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>][<span class="pl-c1">0</span>])) {</span></td>
      </tr>
      <tr>
        <td id="L206" class="blob-num js-line-number" data-line-number="206"></td>
        <td id="LC206" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                <span class="pl-k">foreach</span> (<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>] <span class="pl-k">as</span> <span class="pl-smi">$key</span> <span class="pl-k">=&gt;</span> <span class="pl-smi">$value</span>) {</span></td>
      </tr>
      <tr>
        <td id="L207" class="blob-num js-line-number" data-line-number="207"></td>
        <td id="LC207" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                        <span class="pl-c1">unset</span>(<span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>][<span class="pl-smi">$key</span>]);</span></td>
      </tr>
      <tr>
        <td id="L208" class="blob-num js-line-number" data-line-number="208"></td>
        <td id="LC208" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                        <span class="pl-smi">$this</span><span class="pl-k">-&gt;</span><span class="pl-smi">pointer</span>[<span class="pl-smi">$tag</span>][<span class="pl-c1">0</span>][<span class="pl-smi">$key</span>] <span class="pl-k">=</span> <span class="pl-smi">$value</span>;</span></td>
      </tr>
      <tr>
        <td id="L209" class="blob-num js-line-number" data-line-number="209"></td>
        <td id="LC209" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">                }</span></td>
      </tr>
      <tr>
        <td id="L210" class="blob-num js-line-number" data-line-number="210"></td>
        <td id="LC210" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            }</span></td>
      </tr>
      <tr>
        <td id="L211" class="blob-num js-line-number" data-line-number="211"></td>
        <td id="LC211" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }<span class="pl-k">else</span>{</span></td>
      </tr>
      <tr>
        <td id="L212" class="blob-num js-line-number" data-line-number="212"></td>
        <td id="LC212" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">            <span class="pl-smi">$idx</span> <span class="pl-k">=</span> <span class="pl-c1">null</span>;</span></td>
      </tr>
      <tr>
        <td id="L213" class="blob-num js-line-number" data-line-number="213"></td>
        <td id="LC213" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        }</span></td>
      </tr>
      <tr>
        <td id="L214" class="blob-num js-line-number" data-line-number="214"></td>
        <td id="LC214" class="blob-code blob-code-inner js-file-line"><span class="pl-s1"></span></td>
      </tr>
      <tr>
        <td id="L215" class="blob-num js-line-number" data-line-number="215"></td>
        <td id="LC215" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">        <span class="pl-k">return</span> <span class="pl-smi">$idx</span>;</span></td>
      </tr>
      <tr>
        <td id="L216" class="blob-num js-line-number" data-line-number="216"></td>
        <td id="LC216" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">    }</span></td>
      </tr>
      <tr>
        <td id="L217" class="blob-num js-line-number" data-line-number="217"></td>
        <td id="LC217" class="blob-code blob-code-inner js-file-line"><span class="pl-s1">}</span></td>
      </tr>
</table>

  <div class="BlobToolbar position-absolute js-file-line-actions dropdown js-menu-container js-select-menu d-none" aria-hidden="true">
    <button class="btn-octicon ml-0 px-2 p-0 bg-white border border-gray-dark rounded-1 dropdown-toggle js-menu-target" type="button" aria-expanded="false" aria-haspopup="true" aria-label="Inline file action toolbar" aria-controls="inline-file-actions">
      <svg class="octicon octicon-kebab-horizontal" viewBox="0 0 13 16" version="1.1" width="13" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M1.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg>
    </button>
    <div class="dropdown-menu-content js-menu-content" id="inline-file-actions">
      <ul class="BlobToolbar-dropdown dropdown-menu dropdown-menu-se mt-2">
        <li><clipboard-copy class="dropdown-item" id="js-copy-lines" style="cursor:pointer;" data-original-text="Copy lines">Copy lines</clipboard-copy></li>
        <li><clipboard-copy class="dropdown-item" id="js-copy-permalink" style="cursor:pointer;" data-original-text="Copy permalink">Copy permalink</clipboard-copy></li>
        <li><a class="dropdown-item js-update-url-with-hash" id="js-view-git-blame" href="/andris9/php-sdk/blame/71933e8a60a7a8b73ce2808205aad98981cc47e5/src/xml2array.php">View git blame</a></li>
          <li><a class="dropdown-item" id="js-new-issue" href="/andris9/php-sdk/issues/new">Open new issue</a></li>
      </ul>
    </div>
  </div>

  </div>

  </div>

  <button type="button" data-facebox="#jump-to-line" data-facebox-class="linejump" data-hotkey="l" class="d-none">Jump to Line</button>
  <div id="jump-to-line" style="display:none">
    <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="js-jump-to-line-form" action="" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
      <input class="form-control linejump-input js-jump-to-line-field" type="text" placeholder="Jump to line&hellip;" aria-label="Jump to line" autofocus>
      <button type="submit" class="btn">Go</button>
</form>  </div>


  </div>
  <div class="modal-backdrop js-touch-events"></div>
</div>

    </div>
  </div>

  </div>

      
<div class="footer container-lg px-3" role="contentinfo">
  <div class="position-relative d-flex flex-justify-between pt-6 pb-2 mt-6 f6 text-gray border-top border-gray-light ">
    <ul class="list-style-none d-flex flex-wrap ">
      <li class="mr-3">&copy; 2018 <span title="0.36829s from unicorn-3207540155-gcfhj">GitHub</span>, Inc.</li>
        <li class="mr-3"><a data-ga-click="Footer, go to terms, text:terms" href="https://github.com/site/terms">Terms</a></li>
        <li class="mr-3"><a data-ga-click="Footer, go to privacy, text:privacy" href="https://github.com/site/privacy">Privacy</a></li>
        <li class="mr-3"><a href="https://help.github.com/articles/github-security/" data-ga-click="Footer, go to security, text:security">Security</a></li>
        <li class="mr-3"><a href="https://status.github.com/" data-ga-click="Footer, go to status, text:status">Status</a></li>
        <li><a data-ga-click="Footer, go to help, text:help" href="https://help.github.com">Help</a></li>
    </ul>

    <a aria-label="Homepage" title="GitHub" class="footer-octicon" href="https://github.com">
      <svg height="24" class="octicon octicon-mark-github" viewBox="0 0 16 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
</a>
   <ul class="list-style-none d-flex flex-wrap ">
        <li class="mr-3"><a data-ga-click="Footer, go to contact, text:contact" href="https://github.com/contact">Contact GitHub</a></li>
      <li class="mr-3"><a href="https://developer.github.com" data-ga-click="Footer, go to api, text:api">API</a></li>
      <li class="mr-3"><a href="https://training.github.com" data-ga-click="Footer, go to training, text:training">Training</a></li>
      <li class="mr-3"><a href="https://shop.github.com" data-ga-click="Footer, go to shop, text:shop">Shop</a></li>
        <li class="mr-3"><a href="https://blog.github.com" data-ga-click="Footer, go to blog, text:blog">Blog</a></li>
        <li><a data-ga-click="Footer, go to about, text:about" href="https://github.com/about">About</a></li>

    </ul>
  </div>
  <div class="d-flex flex-justify-center pb-6">
    <span class="f6 text-gray-light"></span>
  </div>
</div>



  <div id="ajax-error-message" class="ajax-error-message flash flash-error">
    <svg class="octicon octicon-alert" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.865 1.52c-.18-.31-.51-.5-.87-.5s-.69.19-.87.5L.275 13.5c-.18.31-.18.69 0 1 .19.31.52.5.87.5h13.7c.36 0 .69-.19.86-.5.17-.31.18-.69.01-1L8.865 1.52zM8.995 13h-2v-2h2v2zm0-3h-2V6h2v4z"/></svg>
    <button type="button" class="flash-close js-ajax-error-dismiss" aria-label="Dismiss error">
      <svg class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/></svg>
    </button>
    You can’t perform that action at this time.
  </div>


    
    <script crossorigin="anonymous" integrity="sha512-Sv4EKM6mPWY+R3ngQFlK2bfhGBOuYDOZi8gmeTqVGYkSIWfLe8P5dKApvgAcb0zPYOYUN0TwFPyQpwqCSSCF/Q==" type="application/javascript" src="https://assets-cdn.github.com/assets/frameworks-be76bcb13250bd59797945b00ea1dded.js"></script>
    
    <script crossorigin="anonymous" async="async" integrity="sha512-vz9w5t2gvTbHRcn2YfUuADV518Sbod3RaoPUpmeQF3yYfNEuhynS6lEZJptCMDuLMm6fHDaToB0IrRVW2k2Ltw==" type="application/javascript" src="https://assets-cdn.github.com/assets/github-22866dbfe9a3b8a1414b1bee311bff0e.js"></script>
    
    
    
    
  <div class="js-stale-session-flash stale-session-flash flash flash-warn flash-banner d-none">
    <svg class="octicon octicon-alert" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.865 1.52c-.18-.31-.51-.5-.87-.5s-.69.19-.87.5L.275 13.5c-.18.31-.18.69 0 1 .19.31.52.5.87.5h13.7c.36 0 .69-.19.86-.5.17-.31.18-.69.01-1L8.865 1.52zM8.995 13h-2v-2h2v2zm0-3h-2V6h2v4z"/></svg>
    <span class="signed-in-tab-flash">You signed in with another tab or window. <a href="">Reload</a> to refresh your session.</span>
    <span class="signed-out-tab-flash">You signed out in another tab or window. <a href="">Reload</a> to refresh your session.</span>
  </div>
  <div class="facebox" id="facebox" style="display:none;">
  <div class="facebox-popup">
    <div class="facebox-content" role="dialog" aria-labelledby="facebox-header" aria-describedby="facebox-description">
    </div>
    <button type="button" class="facebox-close js-facebox-close" aria-label="Close modal">
      <svg class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"/></svg>
    </button>
  </div>
</div>

  <div class="Popover js-hovercard-content position-absolute" style="display: none; outline: none;" tabindex="0">
  <div class="Popover-message Popover-message--bottom-left Popover-message--large Box box-shadow-large" style="width:360px;">
  </div>
</div>

<div id="hovercard-aria-description" class="sr-only">
  Press h to open a hovercard with more details.
</div>


  </body>
</html>

