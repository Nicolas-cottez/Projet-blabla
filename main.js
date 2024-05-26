

        document.addEventListener('DOMContentLoaded', () => {
            const paragraphH1 = document.querySelector('.textH1');
            const wordsH1 = paragraphH1.textContent.trim().split(' ').map(
                word => `<span>${word}&nbsp;</span>`
            );
            paragraphH1.innerHTML = wordsH1.join('');

            const paragraphP = document.querySelector('.textP');
            const wordsP = paragraphP.textContent.trim().split(' ').map(
                word => `<span>${word}&nbsp;</span>`
            );
            paragraphP.innerHTML = wordsP.join('');

            let lastKnownScrollPosition = 0;
            let ticking = false;
            let numjaune = 0;

            function handleScroll() {
                const scrollPosition = window.scrollY;

                if (!ticking) {
                    window.requestAnimationFrame(() => {
                        document.querySelectorAll('.textH1 span, .textP span').forEach((span) => {
                            const spanTop = span.getBoundingClientRect().top + scrollPosition - 350;
                            const spanOffset = span.offsetHeight + 20;

                            const spanVisible = (spanTop - window.innerHeight < scrollPosition);
                            numjaune += 1;
                            if (spanVisible & numjaune != 4 & numjaune != 5 & numjaune != 6) {
                                span.classList.add('reveal');
                            } else if (spanVisible) {
                                span.classList.add('revealjaune');
                            }
                        });
                        ticking = false;
                    });

                    ticking = true;
                }
            }

            // Add scroll event listener
            window.addEventListener('scroll', handleScroll);
        });
