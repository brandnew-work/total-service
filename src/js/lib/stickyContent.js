/*
Usage: Accordion.js
---
import stickyContent from './lib/stickyContent'

// 例：600pxを超えたら出現。footer 付近や最下部では退避
stickyContent(
  'footer', // 非表示にする要素のクラス名
  'sticky', // スクロール時に付与するクラス名のサフィックス
  600       // スクロール開始位置の閾値(px)
);
*/

const stickyContent = (hideClass, suffix = '', scrollHeight = 600) => {
  window.onscroll = () => {
    const body = document.querySelector('body')
    const scrollY = document.documentElement.scrollTop || document.body.scrollTop

    body.classList.toggle(`--${suffix}-scroll-standby`, scrollY > 60)
    body.classList.toggle(`--${suffix}-scroll-ready`, scrollY > scrollHeight - 300)
    body.classList.toggle(`--${suffix}-scroll-on`, scrollY > scrollHeight)

    // hideClassがあればその要素の条件も判定
    if (scrollY > scrollHeight && hideClass) {
      const hide_el = document.querySelector('.' + hideClass)
      if (hide_el) {
        const hide_el_rect = hide_el.getBoundingClientRect()
        if (hide_el_rect.y <= hide_el_rect.height) {
          body.classList.remove(`--${suffix}-scroll-on`)
          body.classList.add(`--${suffix}-scroll-out`)
        } else {
          body.classList.remove(`--${suffix}-scroll-out`)
        }
      }
    }

    if (hideClass) {
      // スクロールが最下部に達した場合は必ず外す
      const atBottom = (window.innerHeight + window.scrollY) >= document.body.offsetHeight
      if (atBottom) {
        body.classList.remove(`--${suffix}-scroll-on`)
        body.classList.add(`--${suffix}-scroll-out`)
      }
    }
  }
}

export { stickyContent as default }