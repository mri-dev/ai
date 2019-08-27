<style media="screen">
  table tr td {
    padding: 10px;
  }
</style>
<table border="0" style="border: none;">
  <tr>
    <td>Név:</td>
    <td><strong><?php echo $name; ?></strong></td>
  </tr>
  <tr>
    <td>E-mail:</td>
    <td><strong><?php echo $email; ?></strong></td>
  </tr>
  <tr>
    <td>Telefonszám:</td>
    <td><strong><?php echo $phone; ?></strong></td>
  </tr>
  <tr>
    <td>Marketing és Üzleti levél hozzájárulás:</td>
    <td><strong><?=(isset($marketing))?'Hozzájárult! Csak releváns tartalmú üzleti megkeresés.':'Nem jártult hozzá!'?></strong></td>
  </tr>
  <?php if ($company != ''): ?>
  <tr>
    <td>Cég neve:</td>
    <td><strong><?php echo $company; ?></strong></td>
  </tr>
  <?php endif; ?>
  <?php if ($szoftver != ''): ?>
  <tr>
    <td>Kiválasztott szoftver:</td>
    <td><strong><?php echo $szoftver; ?></strong></td>
  </tr>
  <?php endif; ?>
  <tr>
    <td colspan="2">
      Üzenet: <br>
      <strong><?php echo nl2br($uzenet); ?></strong>
    </td>
  </tr>
</table>
<br><br>
A(z) <?php echo $contact_type; ?> <?php echo date('Y-m-d H:i:s'); ?> időponttal érkezett!
