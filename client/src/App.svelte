<script>
  async function people(email) {
    const formData = new FormData();
    formData.append("email", email);

    const res = await fetch("./people.php", { method: "POST", body: formData });
    person = JSON.parse(await res.text());
    waiting = false;
    notfound = !person;
  }

  let email;
  let person;

  let waiting = false;
  let notfound = false;

  const args = new URLSearchParams(window.location.search);
  const e = args.get("e");
  if (e) email = e;

  let antiDDOS;
  $: if (email) {
    waiting = true;
    notfound = false;
    clearTimeout(antiDDOS);
    antiDDOS = setTimeout(() => people(email), 1000);
  }
</script>

<div class="bg" />
<main>
  <img src="./client/public/wieniec.webp" alt="wieniec" />
  {#if person}
    <h1>{person[0]}</h1>
    <p>{person[2]}</p>
    <p>{person[3]}</p>
    <p>{person[4]}</p>
  {:else}
    <h1>Wpisz twój email,<br />aby odnaleźć<br />swojego wybrańca...</h1>
    <input type="text" bind:value={email} />
    {#if waiting}<small>Szukamy...</small>{/if}
    {#if notfound}<small>Elfy nic nie znalazły!</small>{/if}
  {/if}
</main>

<style>
  .bg {
    z-index: 0;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-image: url("../bg.gif");
    background-size: cover;
    background-repeat: repeat;
    opacity: 0.2;
  }
  main {
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
    padding: 40px 10px;
    min-height: 100%;
    width: 100vw;
    color: #fff;
    text-align: center;
  }
  img {
    margin-bottom: 20px;
    width: clamp(100px, 20vw, 250px);
  }
  small {
    margin-top: 10px;
  }
</style>
