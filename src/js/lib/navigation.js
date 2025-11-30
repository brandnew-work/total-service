/*
Usage: Navigation.js
---
import Navigation from './lib/navigation'

// header-nav__btnをクリックするとbodyに--nav-onクラスが付与される
Navigation(
  'header-btn', // アクションを起こすボタン
  'body'        // クラス付与先
);
*/

const navigation = (actionBtn, targetElement, callback) => {
  document.addEventListener('click', (e) => {
    const btn = e.target.closest(`.${actionBtn}`)
    if (!btn) return
    if (typeof callback === 'function') callback(e)
    document.querySelector(targetElement)?.classList.toggle('--nav-on')
  });
}

export {navigation as default}