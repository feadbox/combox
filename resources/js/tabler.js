require('@tabler/core');

{
    document.addEventListener('click', e => {
        if (!e) return;

        {
            const path = e.path || (e.composedPath && e.composedPath());

            if (['A', 'BUTTON'].includes(path[0].nodeName)) {
                return;
            }

            path.forEach(dom => {
                if (dom.nodeName === 'TR' && dom.hasAttribute('data-url')) {
                    window.location.href = dom.getAttribute('data-url');

                    return;
                }
            });
        }

        {
            if (e.target.hasAttribute('step-one')) {
                e.preventDefault();

                let stepTwo = e.target.closest('[two-step]').querySelector('[step-two]');

                stepTwo.classList.add('animate-pop');
                stepTwo.removeAttribute('step-two');

                e.target.remove();

                return;
            }
        }
    });
}