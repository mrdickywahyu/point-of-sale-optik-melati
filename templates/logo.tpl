<table>
	<tr>
		{if $identityImage != ''}
			<td width="160">
				<img src="images/outlets/{$identityImage}" width="150">
			</td>
		{/if}
		<td>
			<span style="font-size: 18px; font-weight: bold;">
				{$identityName}
			</span><br>
			<div style="padding-bottom: 10px;">{$identityAddress} {if $identityPhone != ''}, Ph. {$identityPhone}{/if}</div>
		</td>
	</tr>
</table>