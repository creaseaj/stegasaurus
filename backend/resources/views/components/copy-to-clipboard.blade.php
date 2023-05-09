@props(['content' => 'Content' ])

<a {{
		$attributes->merge([
			"class" => "border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-[4px] border-[1px]"
		])
	}} href="#" x-data="{
		isCopied: false,
        toFill: '{{!! $content !!}}',
		copyToClipBoard() {
			if (! navigator.clipboard) {
				textArea = document.createElement('textarea');
				textArea.value = this.$refs.content.innerHTML;

				textArea.style.top = '0';
				textArea.style.left = '0';
				textArea.style.position = 'fixed';

				document.body.appendChild(textArea);
				textArea.focus();
				textArea.select();

				try {
					if (document.execCommand('copy')) {
						this.isCopied = true;
						setTimeout(() => {
							this.isCopied = false;
						}, 2500);
					}
				} catch (err) {
					console.error('Fallback: Oops, unable to copy', err);
				}

				document.body.removeChild(textArea);
				return;
			} else {
				navigator.clipboard.writeText(this.$refs.content.innerHTML)
					.then(() => {
                        console.log(this.$refs.content.innerHTML);
						this.isCopied = true;
						setTimeout(() => {
							this.isCopied = false;
						}, 2500);
					});
			}
		}  
	}" x-on:click.prevent="copyToClipBoard()" x-cloak>
    <span class="hidden" x-ref="content">{!! $content !!}</span>
    <span x-text="isCopied ? 'Copied' : toFill "></span>
</a>