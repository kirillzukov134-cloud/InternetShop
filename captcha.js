let drag;

const box = document.querySelector('.captcha-cont');
const inp = document.getElementById('user_puzzle_order');

const update = () => inp.value = Array.from(box.children,i => i.dataset.id).join(',');

box.ondragstart = e => drag = e.target;
box.ondragover = e => e.preventDefault();
box.ondrop = e => {
    if(drag !== e.target){
        e.target.before(drag);
        update();
    }
};
update();