function convertToSlug(str) {
    str = str.replace(/^\s+|\s+$/g, '');
    str = str.toLowerCase();
    var from = "àãáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }
    str = str.replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    return str;
}

document.addEventListener('DOMContentLoaded', function () {
    const field_name = document.querySelector("#name");
    const field_slug = document.querySelector("#slug");
    
    if (field_name && field_slug) {
        field_name.addEventListener("change", (e) => {
            field_slug.value = convertToSlug(e.target.value);
        });
    }
});