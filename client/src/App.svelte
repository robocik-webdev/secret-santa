<script>
  async function people(token) {
    const formData = new FormData();
    formData.append("token", token);

    const res = await fetch("./people.php", { method: "POST", body: formData });
    json = JSON.parse(await res.text());
  }

  let token;
  let json;

  const args = new URLSearchParams(window.location.search);
  const t = args.get("t");
  if (t) token = t;
  $: people(token);
</script>

<div class="bg" />
<main>
  {#if json}
    <div class="content">
      <h1>Grzeczne dzieci...</h1>
      {#each json as { name, amount }}
        {name} |&nbsp;
      {/each}
      {json[0].name}
    </div>
  {:else}
    <h1>Wpisz hasło żeby zobaczyć listę grzecznych dzieci...</h1>
    <input type="password" bind:value={token} />
  {/if}
</main>

<style>
  .bg {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-image: url("../bgu.jpg");
    background-repeat: no-repeat;
    background-size: cover;
  }
  main {
    position: relative;
    color: #fff;
    margin-top: 40vh;
  }
  .content {
    text-align: center;
  }
</style>
