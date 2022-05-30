let scrollpos = window.scrollY
  const header = document.getElementById("defnav")
  const header_height = header.offsetHeight

  const add_class_on_scroll = () => header.classList.add("nav-bg")
  const remove_class_on_scroll = () => header.classList.remove("nav-bg")

  window.addEventListener('scroll', function() { 
    scrollpos = window.scrollY;

    if (scrollpos >= header_height + 200) { add_class_on_scroll() }
    else { remove_class_on_scroll() }

    console.log(scrollpos)
  })