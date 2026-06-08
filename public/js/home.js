(function () {
    const observer = new IntersectionObserver(
        (entries) =>
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("on");
                    observer.unobserve(entry.target);
                }
            }),
        { threshold: 0.1 }
    );

    document.querySelectorAll(".rv").forEach((element) => observer.observe(element));
    setTimeout(() => document.querySelectorAll(".hero .rv").forEach((element) => element.classList.add("on")), 60);

    const navToggle = document.getElementById("navToggle");
    const siteNav = document.getElementById("siteNav");

    if (navToggle && siteNav) {
        navToggle.addEventListener("click", () => {
            const open = siteNav.classList.toggle("open");

            navToggle.classList.toggle("open", open);
            navToggle.setAttribute("aria-expanded", open ? "true" : "false");
        });

        siteNav.querySelectorAll("a").forEach((link) =>
            link.addEventListener("click", () => {
                siteNav.classList.remove("open");
                navToggle.classList.remove("open");
                navToggle.setAttribute("aria-expanded", "false");
            })
        );
    }

    const sectionLinks = document.querySelectorAll(".site-nav a[data-section]");
    const sections = [...sectionLinks]
        .map((link) => document.getElementById(link.dataset.section))
        .filter(Boolean);

    if (sectionLinks.length && sections.length) {
        const setActiveSection = (id) => {
            sectionLinks.forEach((link) => {
                link.classList.toggle("is-active", link.dataset.section === id);
            });
        };

        const sectionObserver = new IntersectionObserver(
            (entries) => {
                entries
                    .filter((entry) => entry.isIntersecting)
                    .sort((a, b) => b.intersectionRatio - a.intersectionRatio)
                    .forEach((entry) => setActiveSection(entry.target.id));
            },
            {
                rootMargin: "-30% 0px -55% 0px",
                threshold: [0, 0.25, 0.5],
            }
        );

        sections.forEach((section) => sectionObserver.observe(section));
    }
})();